import './bootstrap';

// Load all legacy/UMD scripts as classic scripts in strict order to ensure
// jQuery is global and UMD plugins pick the browser branch (not CommonJS).
(() => {
  const injectScript = (src) => new Promise((resolve, reject) => {
    // Guard against UMD CommonJS branch by temporarily undefining globals
    const prevModule = window.module;
    const prevExports = window.exports;
    try {
      window.module = undefined;
      window.exports = undefined;
    } catch {}

    const el = document.createElement('script');
    el.src = src;
    el.async = false; // preserve execution order
    el.onload = () => {
      // Restore globals
      try {
        window.module = prevModule;
        window.exports = prevExports;
      } catch {}
      resolve();
    };
    el.onerror = (err) => {
      try {
        window.module = prevModule;
        window.exports = prevExports;
      } catch {}
      reject(err);
    };
    document.head.appendChild(el);
  });

  // Ordered load: core libs → jQuery plugins → other UI → legacy globals → site script
  injectScript('/js/jquery.js')
    .then(() => injectScript('/js/popper.min.js'))
    .then(() => injectScript('/js/bootstrap.min.js'))
    .then(() => injectScript('/js/jquery-ui.js'))
    .then(() => injectScript('/js/jquery.easing.min.js'))
    .then(() => injectScript('/js/jquery.fancybox.js'))
    .then(() => injectScript('/js/jquery.mCustomScrollbar.concat.min.js'))
    .then(() => injectScript('/js/jquery.scrollTo.js'))
    .then(() => injectScript('/js/owl.js'))
    .then(() => injectScript('/js/appear.js'))
    .then(() => injectScript('/js/parallax.min.js'))
    .then(() => injectScript('/js/validate.js'))
    .then(() => injectScript('/js/respond.js'))
    .then(() => injectScript('/js/wow.js'))
    .then(() => injectScript('/js/tilt.jquery.min.js'))
    .then(() => injectScript('/js/jquery.paroller.min.js'))
    .then(() => injectScript('/js/script.js'))
    .catch((err) => {
      console.error('Failed to load classic scripts:', err);
    });
})();
