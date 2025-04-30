export const duration = 600;
export const easing = "ease";

export function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

export function clamp(value, min, max) {
  return value < min ? min : value > max ? max : value;
}

function convertCamelToKebabCase(camelCaseString) {
  return camelCaseString.replace(/([a-z])([A-Z])/g, "$1-$2").toLowerCase();
}

export function getStyles(element, properties, computed = true) {
  const styles = computed ? getComputedStyle(element) : element.style;

  const result = {};

  for (const property of properties) {
    result[property] = styles[property];
  }

  return result;
}

export function removeStyleProps(element, properties) {
  for (const property of properties) {
    element.style.removeProperty(convertCamelToKebabCase(property));
  }
}

export function changeMainButtonLabel(label) {
  const buttonTxt = document.querySelector("#next-button span");
  if (!buttonTxt) throw new Error("Couldn't find next-button span");

  const blurAnim = buttonTxt.animate([{ filter: "blur(0px)" }, { filter: "blur(10px)" }], { duration: duration / 2, easing });
  blurAnim.onfinish = () => {
    buttonTxt.textContent = label;
    buttonTxt.animate([{ filter: "blur(10px)" }, { filter: "blur(0px)" }], { duration: duration / 2, easing });
    blurAnim.onfinish = null;
  };
}

export function setPageIndicator(pageNum) {
  const active = document.querySelector(".page-indicator.active");
  if (active) active.classList.remove("active");

  const secondPageIndicator = document.querySelector(`#${pageNum}-page-indicator`);
  if (secondPageIndicator) secondPageIndicator.classList.add("active");
}

export function setGiftTagText(name) {
  const giftTagText = document.querySelector("#gift-tag-text");
  if (!giftTagText) throw new Error("Couldn't find gift-tag-text");

  const maxLength = 70;
  const startX = 94;

  giftTagText.removeAttribute("textLength");
  giftTagText.textContent = name;

  const textLength = giftTagText.getComputedTextLength();

  if (textLength <= maxLength) {
    const center = startX - maxLength / 2 + textLength / 2;
    giftTagText.setAttribute("x", center.toString());
    return;
  }

  giftTagText.setAttribute("textLength", maxLength.toString());
  giftTagText.setAttribute("x", startX.toString());
}

export function handWithPenOnResize() {
  const giftContainer = document.querySelector(".gift-container");
  const handWithPen = document.querySelector(".hand-with-pen");
  if (!giftContainer || !handWithPen) return;

  const giftContainerRect = giftContainer.getBoundingClientRect();
  handWithPen.style.top = `calc(${giftContainerRect.bottom + scrollY - handWithPen.offsetHeight * 0.75}px)`;
}

export function carryingHandOnResize() {
  const giftContainer = document.querySelector(".gift-container");
  const carryingHand = document.querySelector(".carrying-hand");
  if (!giftContainer || !carryingHand) return;
  const rect = giftContainer.getBoundingClientRect();
  carryingHand.style.top = `calc(${rect.bottom + scrollY - carryingHand.offsetHeight * 0.8}px)`;
}

export function clearValidationMessage(e) {
  const inputEl = e.target;
  if (!(inputEl instanceof HTMLInputElement)) return;
  inputEl.setCustomValidity("");
}

export function templateBtnHandler(e) {
  const target = e.target;
  if (!(target instanceof HTMLElement)) return;

  const btn = target.closest(".template-btn");
  if (!btn) return;

  const selectedBtn = document.querySelector(".template-btn.selected");
  if (selectedBtn) selectedBtn.classList.remove("selected");

  btn.classList.add("selected");
}
