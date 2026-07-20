(function () {
    var roleBuyer  = document.getElementById('roleBuyer');
    var roleFarmer = document.getElementById('roleFarmer');
    var farmFields = document.getElementById('farmFields');
    var farmName   = document.getElementById('farm_name');

    // Exit kung wala ang elements — ibig sabihin hindi ito ang registration page
    if (!roleBuyer || !roleFarmer || !farmFields || !farmName) return;

    function toggleFarmFields() {
        var isFarmer = roleFarmer.checked;
        farmFields.classList.toggle('hidden', !isFarmer);
        farmName.required = isFarmer;
    }

    roleBuyer.addEventListener('change', toggleFarmFields);
    roleFarmer.addEventListener('change', toggleFarmFields);
    toggleFarmFields();
})();

 if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/sw.js')
        .then(() => console.log('[SW] Registered'))
        .catch((err) => console.error('[SW] Error:', err));
    });
  }