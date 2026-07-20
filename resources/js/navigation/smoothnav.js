export function initSmoothNav() {
  document.addEventListener("click", function (e) {
    const link = e.target.closest("[data-ajax-link]");
    if (!link) return;

    e.preventDefault();
    const url = link.href;

    const main = document.querySelector("main");
    if (!main) return;

    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    const isMobileSidebarOpen =
      sidebar && !sidebar.classList.contains("-translate-x-full");

    if (window.innerWidth < 768 && isMobileSidebarOpen) {
      sidebar.classList.add("-translate-x-full");
      backdrop?.classList.add("hidden");
    }

    main.style.opacity = '0.3';
    main.style.transition = 'opacity 0.15s ease';

    const doFetch = () => {
      fetch(url)
        .then((res) => {
          if (!res.ok) throw new Error(res.status);
          return res.text();
        })
        .then((html) => {
          if (!html) return;

          const parser = new DOMParser();
          const doc = parser.parseFromString(html, "text/html");
          const newMain = doc.querySelector("main");

          if (!newMain) {
            window.location.href = url;
            return;
          }

          main.innerHTML = newMain.innerHTML;
          main.scrollTop = 0;

          window.history.pushState({}, doc.title, url);
          document.title = doc.title;

          window.dispatchEvent(new CustomEvent('smoothnav:after'));

          if (typeof window.initPage === "function") {
            window.initPage();
          }

          requestAnimationFrame(() => {
            main.style.opacity = '1';
          });
        })
        .catch(() => {
          window.location.href = url;
        });
    };

    doFetch();
  });

  window.addEventListener("popstate", () => {
    const main = document.querySelector("main");
    if (!main) return;
/* 
    main.style.opacity = '0.3';
    main.style.transition = 'opacity 0.15s ease';
 */
    fetch(location.href)
      .then((res) => {
        if (!res.ok) throw new Error(res.status);
        return res.text();
      })
      .then((html) => {
        const doc = new DOMParser().parseFromString(html, "text/html");
        const newMain = doc.querySelector("main");
        if (!newMain) {
          window.location.href = location.href;
          return;
        }
        main.innerHTML = newMain.innerHTML;
        document.title = doc.title;

        window.dispatchEvent(new CustomEvent('smoothnav:after'));

        if (typeof window.initPage === "function") {
          window.initPage();
        }

        requestAnimationFrame(() => {
          main.style.opacity = '1';
        });
      })
      .catch(() => {
        window.location.href = location.href;
      });
  });
}

export function bodyGlitch() {
  document.body.style.transition = "opacity 0.15s ease";

  const show = () => { document.body.style.opacity = "1"; };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", show);
  } else {
    requestAnimationFrame(show);
  }
}