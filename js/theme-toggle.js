(() => {
  if (typeof window === "undefined") return;

  function safeGet(key) {
    try {
      return localStorage.getItem(key);
    } catch (e) {
      return null;
    }
  }

  function safeSet(key, value) {
    try {
      localStorage.setItem(key, value);
    } catch (e) {}
  }

  // support both keys for backward compatibility
  const PRIMARY_KEY = "theme"; // used by script.js
  const LEGACY_KEY = "force_theme_mode";

  function applyTheme(mode) {
    const root = document.documentElement;
    const btn = document.getElementById("themeToggle");
    if (mode === "dark") {
      root.setAttribute("data-theme", "dark");
      if (btn) btn.setAttribute("aria-pressed", "true");
    } else {
      root.removeAttribute("data-theme");
      if (btn) btn.setAttribute("aria-pressed", "false");
    }
  }

  // run after DOM ready to avoid missing the button on some templates
  document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("themeToggle");

    // read primary key first, then fallback to legacy key
    const saved = safeGet(PRIMARY_KEY) || safeGet(LEGACY_KEY);
    if (saved === "dark") {
      applyTheme("dark");
    }

    if (!btn) return; // nothing to bind

    btn.addEventListener("click", function () {
      const isDark =
        document.documentElement.getAttribute("data-theme") === "dark";
      const next = isDark ? "light" : "dark";
      applyTheme(next);

      // write both keys so older pages/scripts pick it up too
      safeSet(PRIMARY_KEY, next === "dark" ? "dark" : "light");
      safeSet(LEGACY_KEY, next === "dark" ? "dark" : "light");
    });
  });
})();
