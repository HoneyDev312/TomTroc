const input = document.getElementById("pictureFile");
const form = document.getElementById("update-picture-form");
const searchInput = document.querySelector(".ourBooks-search");
const searchForm = document.querySelector(".ourBooks-form");
const thread = document.querySelector(".messaging-thread-content");
const messagingForm = document.querySelector(".messaging-thread-form");

//Upload user and book picture
if (input && form) {
  input.addEventListener("change", () => {
    if (input.files && input.files.length > 0) {
      form.submit();
    }
  });
}

// Recherche de livre par titre

if (searchInput && searchForm) {
  searchInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      searchForm.submit();
    }
  });
}

function scrollToBottom() {
  if (!thread) return;
  thread.scrollTop = thread.scrollHeight;
}

// Scroll en bas de la conversation après l'envoir d'un message
window.addEventListener("load", scrollToBottom);

messagingForm?.addEventListener("submit", () => {
  scrollToBottom();
});

// toggle du burger menu en mobile
const toggle = document.querySelector(".nav-toggle-menu");
const mobileMenu = document.querySelector(".nav-mobile-menu");

if (toggle && mobileMenu) {
  toggle.addEventListener("click", () => {
    const isOpen = mobileMenu.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", String(isOpen));
  });
}
