<?php if (!defined('ABSPATH')) exit; ?>
<section data-calculator-root class="tw-my-8 tw-bg-white tw-shadow tw-rounded-2xl tw-p-6">
  <header class="tw-mb-4">
    <h2 class="tw-text-2xl tw-font-semibold">BMI Calculator</h2>
    <p class="tw-text-sm tw-text-gray-500">No data is stored.</p>
  </header>

  <form class="tw-space-y-4" data-calc-type="bmi" novalidate>
    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4">
      <label class="tw-block">
        <span class="tw-block tw-text-sm tw-font-medium tw-mb-1">Height (cm)</span>
        <input name="height" type="number" min="0" step="0.1" class="tw-w-full tw-rounded-xl tw-border tw-px-3 tw-py-2" placeholder="e.g., 175">
      </label>
      <label class="tw-block">
        <span class="tw-block tw-text-sm tw-font-medium tw-mb-1">Weight (kg)</span>
        <input name="weight" type="number" min="0" step="0.1" class="tw-w-full tw-rounded-xl tw-border tw-px-3 tw-py-2" placeholder="e.g., 72">
      </label>
    </div>
    <div class="tw-flex tw-items-center tw-justify-between">
      <button type="button" class="calc-submit tw-rounded-xl tw-px-4 tw-py-2 tw-bg-black tw-text-white">Calculate</button>
      <button type="reset" class="tw-rounded-xl tw-px-3 tw-py-2 tw-border">Reset</button>
    </div>
  </form>

  <div class="tw-mt-6 tw-grid tw-grid-cols-1 sm:tw-grid-cols-3 tw-gap-4" aria-live="polite">
    <div class="tw-p-4 tw-bg-gray-50 tw-rounded-xl">
      <div class="tw-text-sm tw-text-gray-500">BMI</div>
      <div class="calc-out tw-text-xl tw-font-semibold">—</div>
    </div>
    <div class="tw-p-4 tw-bg-gray-50 tw-rounded-xl">
      <div class="tw-text-sm tw-text-gray-500">Category</div>
      <div class="calc-out tw-text-xl tw-font-semibold">—</div>
    </div>
    <div class="tw-p-4 tw-bg-gray-50 tw-rounded-xl">
      <div class="tw-text-sm tw-text-gray-500">Healthy Range</div>
      <div class="calc-out tw-text-xl tw-font-semibold">—</div>
    </div>
  </div>

  <details class="tw-mt-4">
    <summary class="tw-cursor-pointer tw-text-sm tw-text-gray-600">How it works</summary>
    <p class="tw-text-sm tw-text-gray-600 tw-mt-2">BMI = weight (kg) / (height (m))². &lt;18.5 underweight, 18.5–24.9 normal, 25–29.9 overweight, ≥30 obese.</p>
  </details>
</section>
