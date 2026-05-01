document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector("[data-login-form]");

  if (!loginForm) {
    return;
  }

  loginForm.addEventListener("submit", () => {
    const submitButton = loginForm.querySelector('button[type="submit"]');

    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = "登录中...";
    }
  });
});
