
(function () {

    function activate(tab, setHash = true) {
        const tablist = tab.parentElement;
        const tabs = Array.from(tablist.querySelectorAll('[role="tab"]'));
        const panels = tabs.map(t => document.getElementById(t.getAttribute('aria-controls')));

        tabs.forEach((t, i) => {
            const selected = t === tab;
            t.setAttribute('aria-selected', selected ? 'true' : 'false');
            t.tabIndex = selected ? 0 : -1;
            if (panels[i]) panels[i].hidden = !selected;

            // Toggle Tailwind classes for active/inactive states
            t.classList.toggle('border-black', selected);
            t.classList.toggle('text-black', selected);
            t.classList.toggle('font-semibold', selected);
            t.classList.toggle('border-transparent', !selected);
            t.classList.toggle('text-gray-600', !selected);
            t.classList.toggle('font-normal', !selected);
            t.classList.toggle('bg-gray-100', !selected);
        });

        if (setHash) {
            const id = tab.id.replace(/^tab-/, '');
            history.replaceState(null, '', `#${id}`);
        }
    }

    function onKey(e) {
        const key = e.key;
        if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(key)) return;
        const tabs = Array.from(e.currentTarget.querySelectorAll('[role="tab"]'));
        const idx = tabs.indexOf(document.activeElement);
        let next = idx;
        if (key === 'ArrowRight') next = (idx + 1) % tabs.length;
        if (key === 'ArrowLeft') next = (idx - 1 + tabs.length) % tabs.length;
        if (key === 'Home') next = 0;
        if (key === 'End') next = tabs.length - 1;
        tabs[next].focus();
        activate(tabs[next]);
    }

    function bootTabs() {
        const container = document.getElementById('calc-tabs');
        if (!container) return;
        const tablist = container.querySelector('[role="tablist"]');
        const tabs = tablist.querySelectorAll('[role="tab"]');

        tabs.forEach(btn => btn.addEventListener('click', () => activate(btn)));
        tablist.addEventListener('keydown', onKey);

        // Activate correct tab from URL hash if present
        const h = (location.hash || '').replace('#', '');
        const target = h ? container.querySelector(`#tab-${h}`) : null;
        if (target) activate(target, false);
        else activate(container.querySelector('#tab-bmi'), false);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bootTabs);
    } else {
        bootTabs();
    }

    // ===== Utilities =====
    function fmt(n, d = 2) { return Number.isFinite(n) ? Number(n).toFixed(d) : '—'; }
    function log10(x) { return Math.log(x) / Math.LN10; }
    function clamp(n, min, max) { return Math.min(Math.max(n, min), max); }

    // ===== BMI =====
    function bmiCat(bmi) {
        if (bmi < 18.5) return 'Underweight';
        if (bmi < 25) return 'Normal';
        if (bmi < 30) return 'Overweight';
        return 'Obese';
    }
    function healthyRange(hCm, minBmi = 18.5, maxBmi = 24.9) {
        const hM = hCm / 100;
        const minW = minBmi * (hM ** 2);
        const maxW = maxBmi * (hM ** 2);
        return `${fmt(minW, 1)}–${fmt(maxW, 1)} kg`;
    }
    function handleBMI(form, outs) {
        const h = parseFloat(form.height.value || 0);
        const w = parseFloat(form.weight.value || 0);
        if (h <= 0 || w <= 0) return outs.forEach(o => o.textContent = '—');
        const bmi = w / Math.pow(h / 100, 2);
        outs[0].textContent = fmt(bmi, 2);
        outs[1].textContent = bmiCat(bmi);
        outs[2].textContent = healthyRange(h);
    }

    // ===== BMR (Mifflin–St Jeor) =====
    function bmrMifflin({ gender, weightKg, heightCm, age }) {
        return (gender === 'female')
            ? 10 * weightKg + 6.25 * heightCm - 5 * age - 161
            : 10 * weightKg + 6.25 * heightCm - 5 * age + 5;
    }
    function handleBMR(form, outs) {
        const gender = form.gender.value || 'male';
        const weight = parseFloat(form.weight.value || 0);
        const height = parseFloat(form.height.value || 0);
        const age = parseInt(form.age.value || 0, 10);
        if (weight <= 0 || height <= 0 || age <= 0) return outs.forEach(o => o.textContent = '—');
        const bmr = bmrMifflin({ gender, weightKg: weight, heightCm: height, age });
        outs[0].textContent = fmt(bmr, 0);
    }

    // ===== TDEE (activity multipliers) =====
    const activityMap = {
        sedentary: 1.2,
        light: 1.375,
        moderate: 1.55,
        active: 1.725,
        very_active: 1.9
    };
    function handleCalories(form, outs) {
        const gender = form.gender.value || 'male';
        const weight = parseFloat(form.weight.value || 0);
        const height = parseFloat(form.height.value || 0);
        const age = parseInt(form.age.value || 0, 10);
        const activity = activityMap[form.activity.value] || activityMap.sedentary;
        if (weight <= 0 || height <= 0 || age <= 0) return outs.forEach(o => o.textContent = '—');
        const bmr = bmrMifflin({ gender, weightKg: weight, heightCm: height, age });
        const tdee = bmr * activity;
        outs[0].textContent = fmt(bmr, 0);
        outs[1].textContent = fmt(tdee, 0);
        // Simple macro suggestion (30/25/45 P/F/C by calories)
        const proteinG = (tdee * 0.30) / 4;
        const fatG = (tdee * 0.25) / 9;
        const carbG = (tdee * 0.45) / 4;
        outs[2].textContent = `${fmt(proteinG, 0)}g / ${fmt(fatG, 0)}g / ${fmt(carbG, 0)}g`;
    }

    // ===== Body Fat % (US Navy method) =====
    // male:   BF% = 495/(1.0324 - 0.19077*log10(waist-neck) + 0.15456*log10(height)) - 450
    // female: BF% = 495/(1.29579 - 0.35004*log10(waist+hip-neck) + 0.22100*log10(height)) - 450
    function handleBodyFat(form, outs) {
        const gender = form.gender.value || 'male';
        const height = parseFloat(form.height.value || 0);
        const neck = parseFloat(form.neck.value || 0);
        const waist = parseFloat(form.waist.value || 0);
        const hip = parseFloat(form.hip?.value || 0);
        if (height <= 0 || neck <= 0 || waist <= 0 || (gender === 'female' && hip <= 0)) {
            return outs.forEach(o => o.textContent = '—');
        }

        let bf;
        if (gender === 'female') {
            const A = (waist + hip) - neck;
            if (A <= 0) return outs.forEach(o => o.textContent = '—');
            bf = 495 / (1.29579 - 0.35004 * log10(A) + 0.22100 * log10(height)) - 450;
        } else {
            const A = waist - neck;
            if (A <= 0) return outs.forEach(o => o.textContent = '—');
            bf = 495 / (1.0324 - 0.19077 * log10(A) + 0.15456 * log10(height)) - 450;
        }
        if (!Number.isFinite(bf)) return outs.forEach(o => o.textContent = '—');
        bf = clamp(bf, 2, 75);

        outs[0].textContent = `${fmt(bf, 1)}%`;

        // rough category ranges
        let cat = 'Average';
        if (gender === 'male') {
            if (bf < 6) cat = 'Essential';
            else if (bf < 14) cat = 'Athlete';
            else if (bf < 18) cat = 'Fit';
            else if (bf < 25) cat = 'Average';
            else cat = 'Obese';
        } else {
            if (bf < 14) cat = 'Essential';
            else if (bf < 21) cat = 'Athlete';
            else if (bf < 25) cat = 'Fit';
            else if (bf < 32) cat = 'Average';
            else cat = 'Obese';
        }
        outs[1].textContent = cat;
    }

    // ===== Binder =====
    function bindCalc(root) {
        const form = root.querySelector('form');
        const outs = root.querySelectorAll('.calc-out');
        const type = form?.dataset?.calcType;

        root.querySelector('.calc-submit')?.addEventListener('click', function () {
            if (type === 'bmr') return handleBMR(form, outs);
            if (type === 'calories') return handleCalories(form, outs);
            if (type === 'bodyfat') return handleBodyFat(form, outs);
            // default BMI
            return handleBMI(form, outs);
        });

        form?.addEventListener('reset', () => outs.forEach(o => o.textContent = '—'));

        // Bodyfat: show/hide hip by gender
        if (type === 'bodyfat') {
            const genderSel = form.querySelector('select[name="gender"]');
            const hipWrap = form.querySelector('#bf-hip-wrap');
            const toggleHip = () => {
                if (!genderSel || !hipWrap) return;
                hipWrap.style.display = (genderSel.value === 'female') ? '' : 'none';
            };
            genderSel && genderSel.addEventListener('change', toggleHip);
            toggleHip();
        }
    }

    function boot() {
        document.querySelectorAll('[data-calculator-root]').forEach(bindCalc);
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();