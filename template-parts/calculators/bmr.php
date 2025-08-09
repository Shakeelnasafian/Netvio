<?php if (!defined('ABSPATH')) exit; ?>
<section data-calculator-root class="my-8 bg-white shadow rounded-2xl p-6">
  <header class="mb-4">
    <h2 class="text-2xl font-semibold">BMR Calculator (Mifflin–St Jeor)</h2>
    <p class="text-sm text-gray-500">Metric units. No data stored.</p>
  </header>

  <form class="space-y-4" data-calc-type="bmr" novalidate>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <label class="block">
        <span class="block text-sm font-medium mb-1">Gender</span>
        <select name="gender" class="w-full rounded-xl border px-3 py-2">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </label>
      <label class="block">
        <span class="block text-sm font-medium mb-1">Age (years)</span>
        <input name="age" type="number" min="1" step="1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 30">
      </label>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <label class="block">
        <span class="block text-sm font-medium mb-1">Height (cm)</span>
        <input name="height" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 175">
      </label>
      <label class="block">
        <span class="block text-sm font-medium mb-1">Weight (kg)</span>
        <input name="weight" type="number" min="0" step="0.1" class="w-full rounded-xl border px-3 py-2" placeholder="e.g., 72">
      </label>
    </div>

    <div class="flex items-center justify-between">
      <button type="button" class="calc-submit rounded-xl px-4 py-2 bg-black text-white">Calculate</button>
      <button type="reset" class="rounded-xl px-3 py-2 border">Reset</button>
    </div>
  </form>

  <div class="mt-6 grid grid-cols-1 sm:grid-cols-1 gap-4" aria-live="polite">
    <div class="p-4 bg-gray-50 rounded-xl">
      <div class="text-sm text-gray-500">BMR (kcal/day)</div>
      <div class="calc-out text-xl font-semibold">—</div>
    </div>
  </div>
</section>
