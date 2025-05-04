import { carryingHandOnResize, duration, easing, getStyles, handWithPenOnResize, removeStyleProps } from "./utils.js";

const fill = "forwards";

export function giftAnimation(state) {
  const giftContainer = document.querySelector(".gift-container");
  if (!giftContainer) throw new Error("Couldn't find gift-container");

  const giftTag = giftContainer.querySelector(".gift-tag");
  if (!giftTag) throw new Error("Couldn't find gift-tag");

  const handWithPen = document.querySelector(".hand-with-pen");
  if (!handWithPen) throw new Error("Couldn't find hand-with-pen");

  const carryingHand = document.querySelector(".carrying-hand");
  if (!carryingHand) throw new Error("Couldn't find carrying-hand");

  const smallGiftStart = giftContainer.querySelector(".gift-small-start");
  if (!smallGiftStart) throw new Error("Couldn't find small-gift-start");

  const smallGiftEnd = giftContainer.querySelector(".gift-small-end");
  if (!smallGiftEnd) throw new Error("Couldn't find small-gift-end");

  smallGiftStart.animate([{}, { transform: "translateX(-90%)" }], {
    direction: "alternate",
    iterations: 2,
    duration: 200,
    easing: "ease-in",
  });

  smallGiftEnd.animate([{}, { transform: "translateX(90%)" }], {
    direction: "alternate",
    iterations: 2,
    duration: 200,
    easing: "ease-in",
  });

  if (state === "page2") {
    const tagAnim = giftTag.animate([{}, { rotate: "130deg", scale: "0" }], { duration, easing: "ease", fill });
    tagAnim.onfinish = () => {
      tagAnim.commitStyles();
      tagAnim.cancel();
      tagAnim.onfinish = null;
    };

    window.removeEventListener("resize", handWithPenOnResize);
    const handWithPenFrom = getStyles(handWithPen, ["top"], false);
    removeStyleProps(handWithPen, Object.keys(handWithPenFrom));
    const handWithPenAnim = handWithPen.animate(
      [handWithPenFrom, { top: "50%", insetInlineStart: "0", transform: "translate(100%, -50%)" }],
      { duration, easing, fill }
    );
    handWithPenAnim.onfinish = () => {
      handWithPenAnim.commitStyles();
      handWithPenAnim.cancel();
      handWithPenAnim.onfinish = null;
    };

    const startTime = performance.now();
    (function checkPosition() {
      const rect = giftContainer.getBoundingClientRect();
      carryingHand.style.top = `calc(${rect.bottom + scrollY - carryingHand.offsetHeight * 0.8}px)`;
      if (performance.now() - startTime < duration) requestAnimationFrame(checkPosition);
    })();

    const handFrom = getStyles(carryingHand, ["insetInlineEnd", "rotate", "transform"], false);
    removeStyleProps(carryingHand, Object.keys(handFrom));

    const handAnim = carryingHand.animate(
      [handFrom, { insetInlineEnd: "50%", rotate: "0deg", transform: "translate(-90%, 0)" }],
      { duration, easing, fill }
    );
    handAnim.onfinish = () => {
      handAnim.commitStyles();
      handAnim.cancel();
      handAnim.onfinish = null;
      window.addEventListener("resize", carryingHandOnResize);
    };

    return;
  }

  if (state === "page3") {
    const tagFrom = getStyles(giftTag, ["rotate", "scale"], false);
    removeStyleProps(giftTag, Object.keys(tagFrom));
    giftTag.animate([tagFrom, {}], { duration, easing, fill });

    const giftContainerRect = giftContainer.getBoundingClientRect();
    handWithPen.style.top = `calc(${giftContainerRect.bottom + scrollY - handWithPen.offsetHeight * 0.75}px)`;

    const handWithPenFrom = getStyles(handWithPen, ["insetInlineStart", "transform"], false);
    removeStyleProps(handWithPen, Object.keys(handWithPenFrom));

    const handWithPenAnim = handWithPen.animate([handWithPenFrom, { insetInlineStart: "50%", transform: "translate(100%, 0)" }], {
      duration,
      easing,
      fill,
    });
    handWithPenAnim.onfinish = () => {
      handWithPenAnim.commitStyles();
      handWithPenAnim.cancel();
      handWithPenAnim.onfinish = null;
      window.addEventListener("resize", handWithPenOnResize);
    };

    window.removeEventListener("resize", carryingHandOnResize);
    const handFrom = getStyles(carryingHand, ["top"], false);
    removeStyleProps(carryingHand, Object.keys(handFrom));
    const handAnim = carryingHand.animate(
      [handFrom, { top: "75%", insetInlineEnd: "0", rotate: "90deg", transform: "translate(-100%, 50%)" }],
      { duration, easing, fill }
    );

    handAnim.onfinish = () => {
      handAnim.commitStyles();
      handAnim.cancel();
      handAnim.onfinish = null;
    };
    return;
  }
}

export function switchInputs(state) {
  const page2InputContainer = document.querySelector(".page-2-inputs");
  const page3InputContainer = document.querySelector(".page-3-inputs");

  if (!page2InputContainer) throw new Error("Couldn't find page-2-inputs");
  if (!page3InputContainer) throw new Error("Couldn't find page-3-inputs");

  if (state === "page2") {
    const page2InputAnim = page3InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(-50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page2InputAnim.onfinish = () => {
      page3InputContainer.style.display = "none";

      page2InputContainer.style.removeProperty("display");
      page2InputContainer.animate(
        [
          { opacity: "0", transform: "translateX(50%)" },
          { opacity: "1", transform: "translateX(0)" },
        ],

        { duration: duration * 0.75, easing }
      );

      page2InputAnim.onfinish = null;
    };
    return;
  }

  if (state === "page3") {
    const page1InputAnim = page2InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page1InputAnim.onfinish = () => {
      page2InputContainer.style.display = "none";

      page3InputContainer.style.removeProperty("display");
      page3InputContainer.animate(
        [
          { opacity: "0", transform: "translateX(-50%)" },
          { opacity: "1", transform: "translateX(0)" },
        ],

        { duration: duration * 0.75, easing }
      );

      page1InputAnim.onfinish = null;
    };
    return;
  }
}
