document.querySelectorAll('.toast').forEach((toastTarget) => {
  return new bootstrap.Toast(toastTarget).show();
});
