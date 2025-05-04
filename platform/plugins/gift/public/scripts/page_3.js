import { duration, easing, getStyles, handWithPenOnResize, removeStyleProps } from "./utils.js";

const fill = "forwards";

export function giftAnimation(state) {
  const contentContainer = document.querySelector(".content");
  if (!contentContainer) throw new Error("Couldn't find content-container");

  const giftContainer = document.querySelector(".gift-container");
  if (!giftContainer) throw new Error("Couldn't find gift-container");

  const handWithPen = document.querySelector(".hand-with-pen");
  if (!handWithPen) throw new Error("Couldn't find hand-with-pen");

  const giftTag = giftContainer.querySelector(".gift-tag");
  if (!giftTag) throw new Error("Couldn't find gift-tag");

  const smallGiftStart = giftContainer.querySelector(".gift-small-start");
  if (!smallGiftStart) throw new Error("Couldn't find small-gift-start");

  const smallGiftEnd = giftContainer.querySelector(".gift-small-end");
  if (!smallGiftEnd) throw new Error("Couldn't find small-gift-end");

  const slider = document.querySelector(".slider");
  if (!slider) throw new Error("Couldn't find slider");

  const dur = duration / 2;

  if (state === "page3") {
    const sliderAnim = slider.animate(
      [
        { opacity: "1", scale: "1" },
        { opacity: "0", scale: "0.5" },
      ],

      { duration: dur, easing, fill }
    );
    sliderAnim.onfinish = () => {
      slider.style.display = "none";
      sliderAnim.onfinish = null;

      contentContainer.style.removeProperty("margin-inline");

      giftContainer.style.removeProperty("display");
      const giftContainerAnim = giftContainer.animate([{}, { opacity: "1", transform: "scale(1.2)" }], {
        duration: dur,
        easing,
        fill,
      });
      giftContainerAnim.onfinish = () => {
        giftContainerAnim.commitStyles();
        giftContainerAnim.cancel();
        giftContainerAnim.onfinish = null;
      };

      const smallGiftStartFrom = getStyles(smallGiftStart, ["transform"], false);
      removeStyleProps(smallGiftStart, Object.keys(smallGiftStartFrom));
      smallGiftStart.animate([smallGiftStartFrom, {}], { duration: dur, easing, fill });

      const smallGiftEndFrom = getStyles(smallGiftEnd, ["transform"], false);
      removeStyleProps(smallGiftEnd, Object.keys(smallGiftEndFrom));
      smallGiftEnd.animate([smallGiftEndFrom, {}], { duration: dur, easing, fill });

      const tagFrom = getStyles(giftTag, ["rotate", "scale"], false);
      removeStyleProps(giftTag, Object.keys(tagFrom));
      giftTag.animate([tagFrom, {}], { duration: dur, easing, fill });

      const interval = setInterval(handWithPenOnResize, 1);

      const handWithPenFrom = getStyles(handWithPen, ["insetInlineStart", "transform"], false);
      removeStyleProps(handWithPen, Object.keys(handWithPenFrom));

      const handWithPenAnim = handWithPen.animate(
        [handWithPenFrom, { insetInlineStart: "50%", transform: "translate(100%, 0)" }],
        {
          duration: dur,
          easing,
          fill,
        }
      );
      handWithPenAnim.onfinish = () => {
        clearInterval(interval);
        handWithPenAnim.commitStyles();
        handWithPenAnim.cancel();
        handWithPenAnim.onfinish = null;
        window.addEventListener("resize", handWithPenOnResize);
      };
    };

    return;
  }

  if (state === "page4") {
    const smallGiftStartAnim = smallGiftStart.animate([{}, { transform: "translateX(-100%)" }], {
      duration: dur,
      easing,
      fill,
    });
    smallGiftStartAnim.onfinish = () => {
      smallGiftStartAnim.commitStyles();
      smallGiftStartAnim.cancel();
      smallGiftStartAnim.onfinish = null;
    };
    const smallGiftEndAnim = smallGiftEnd.animate([{}, { transform: "translateX(100%)" }], { duration: dur, easing, fill });
    smallGiftEndAnim.onfinish = () => {
      smallGiftEndAnim.commitStyles();
      smallGiftEndAnim.cancel();
      smallGiftEndAnim.onfinish = null;
    };

    const tagAnim = giftTag.animate([{}, { rotate: "130deg", scale: "0" }], { duration: dur, easing: "ease", fill });
    tagAnim.onfinish = () => {
      tagAnim.commitStyles();
      tagAnim.cancel();
      tagAnim.onfinish = null;
    };

    const giftContainerAnim = giftContainer.animate([{}, { opacity: "0", transform: "scale(0.5)" }], {
      duration: dur,
      easing,
      fill,
    });
    giftContainerAnim.onfinish = () => {
      giftContainerAnim.commitStyles();
      giftContainer.style.display = "none";
      giftContainerAnim.cancel();
      giftContainerAnim.onfinish = null;
    };

    window.removeEventListener("resize", handWithPenOnResize);
    const handWithPenFrom = getStyles(handWithPen, ["top"], false);
    removeStyleProps(handWithPen, Object.keys(handWithPenFrom));
    const handWithPenAnim = handWithPen.animate(
      [handWithPenFrom, { top: "50%", insetInlineStart: "0", transform: "translate(100%, -50%)" }],
      {
        duration: dur,
        easing,
        fill,
      }
    );
    handWithPenAnim.onfinish = () => {
      handWithPenAnim.commitStyles();
      handWithPenAnim.cancel();
      handWithPenAnim.onfinish = null;

      contentContainer.style.marginInline = "0";

      slider.style.removeProperty("display");
      slider.animate(
        [
          { opacity: "0", scale: "0.5" },
          { opacity: "1", scale: "1" },
        ],

        { duration: dur, easing, fill }
      );
    };

    return;
  }
}

export function switchInputs(state) {
  const page3InputContainer = document.querySelector(".page-3-inputs");
  const page4InputContainer = document.querySelector(".page-4-inputs");

  if (!page3InputContainer) throw new Error("Couldn't find page-3-inputs");
  if (!page4InputContainer) throw new Error("Couldn't find page-4-inputs");

  if (state === "page3") {
    const page2InputAnim = page4InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(-50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page2InputAnim.onfinish = () => {
      page4InputContainer.style.display = "none";

      page3InputContainer.style.removeProperty("display");
      page3InputContainer.animate(
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

  if (state === "page4") {
    const page1InputAnim = page3InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page1InputAnim.onfinish = () => {
      page3InputContainer.style.display = "none";

      page4InputContainer.style.removeProperty("display");
      page4InputContainer.animate(
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
