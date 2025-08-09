<?php if (!defined('ABSPATH')) exit; ?>
<section data-calculator-root class="my-8 bg-white shadow rounded-2xl p-6">
  <header class="mb-4">
    <h2 class="text-2xl font-semibold">Body Fat % (US Navy)</h2>
    <p class="text-sm text-gray-500">Metric units (cm). For women, hip is required.</p>
  </header>

  <form class="space-y-4" data-calc-type="bodyfat" novalidate>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <label class="block">
        <span class="block text-sm font-medium mb-1">Gender</span>
        <select name="gender" class="w-full rounded-xl border px-3 py-2" id="bf-gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </label>
      <label class="block">
        <span class="block text-sm font-medium mb-1">Height (cm)</span>
        <input name="height" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 175">
      </label>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <label class="block">
        <span class="block text-sm font-medium mb-1">Neck (cm)</span>
        <input name="neck" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 38">
      </label>
      <label class="block">
        <span class="block text-sm font-medium mb-1">Waist (cm)</span>
        <input name="waist" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 85">
      </label>
      <label class="block" id="bf-hip-wrap">
        <span class="block text-sm font-medium mb-1">Hip (cm) — women only</span>
        <input name="hip" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 95">
      </label>
    </div>

    <div class="flex items-center justify-between">
      <button type="button" class="calc-submit rounded-xl px-4 py-2 bg-black text-white">Calculate</button>
      <button type="reset" class="rounded-xl px-3 py-2 border">Reset</button>
    </div>
  </form>

  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4" aria-live="polite">
    <div class="p-4 bg-gray-50 rounded-xl">
      <div class="text-sm text-gray-500">Body Fat %</div>
      <div class="calc-out text-xl font-semibold">—</div>
    </div>
    <div class="p-4 bg-gray-50 rounded-xl">
      <div class="text-sm text-gray-500">Category</div>
      <div class="calc-out text-xl font-semibold">—</div>
    </div>
  </div>

  <details class="mt-4">
    <summary class="cursor-pointer text-sm text-gray-600">How it works</summary>
    <p class="text-sm text-gray-600 mt-2">US Navy method (metric): male uses log10(waist − neck), female uses log10(waist + hip − neck), both with log10(height).</p>
  </details>
</section>
