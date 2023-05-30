//paralax
window.addEventListener("scroll", () => {
  document.body.style.cssText = `--scrollTop:${this.scrollY}px`;
});
