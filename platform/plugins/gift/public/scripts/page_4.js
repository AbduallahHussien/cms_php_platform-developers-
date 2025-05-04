import { duration, easing, getStyles, removeStyleProps } from "./utils.js";

const fill = "forwards";

export function imgAnimation(state) {
  const contentContainer = document.querySelector(".content");
  if (!contentContainer) throw new Error("Couldn't find content-container");

  const slider = document.querySelector(".slider");
  if (!slider) throw new Error("Couldn't find slider");

  const msgBubble = document.querySelector(".msg-bubble");
  if (!msgBubble) throw new Error("Couldn't find msg-bubble");

  const msgBubbleTop = document.querySelector(".msg-bubble-top");
  if (!msgBubbleTop) throw new Error("Couldn't find msg-bubble-top");

  const msgBubbleBottom = document.querySelector(".msg-bubble-bottom");
  if (!msgBubbleBottom) throw new Error("Couldn't find msg-bubble-bottom");

  const dur = duration * 0.5;

  if (state === "page4") {
    msgBubbleTop.animate([{ opacity: "0", translate: "-100% -50%" }], { duration: dur, easing });
    const msgBubbleBottomAnim = msgBubbleBottom.animate([{ opacity: "0", translate: "100% 50%" }], {
      duration: dur,
      easing,
    });
    msgBubbleBottomAnim.onfinish = () => {
      msgBubble.style.display = "none";
      msgBubbleBottomAnim.onfinish = null;

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

  if (state === "page5") {
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

      msgBubble.style.removeProperty("display");
    };
    return;
  }
}

export function controlsAnimation(state) {
  const indicators = document.querySelectorAll(".page-indicator");
  const nextButton = document.querySelector("#next-button");
  const backButtonBackIcon = document.querySelector(".back-button-icon");
  const backButtonHomeIcon = document.querySelector(".back-button-home-icon");
  const nextButtonContainer = nextButton?.parentElement;
  const controlButtons = document.querySelector(".controls-buttons");

  if (!indicators.length) throw new Error("Couldn't find page-indicator");
  if (!nextButton) throw new Error("Couldn't find next-button");
  if (!nextButtonContainer) throw new Error("Couldn't find next-button-container");
  if (!controlButtons) throw new Error("Couldn't find control-buttons");
  if (!backButtonBackIcon) throw new Error("Couldn't find back-button-icon");
  if (!backButtonHomeIcon) throw new Error("Couldn't find back-button-home-icon");

  if (state === "page4") {
    for (let i = 0; i < indicators.length; i++) {
      const indicator = indicators[i];
      const fromStyle = getStyles(indicator, ["transform"], false);
      setTimeout(() => {
        removeStyleProps(indicator, Object.keys(fromStyle));
        indicator.animate([fromStyle, { transform: "translateY(0)" }], { duration: duration - i * 100, easing });
      }, i * 100);
    }

    const backButtonHomeIconAnim = backButtonHomeIcon.animate([{}, { filter: "blur(10px)" }], { duration: duration / 2, easing });
    backButtonHomeIconAnim.onfinish = () => {
      backButtonHomeIcon.style.display = "none";
      backButtonBackIcon.style.display = "block";
      backButtonBackIcon.animate([{ filter: "blur(10px)" }, {}], { duration: duration / 2, easing });
    };

    const nextButtonFrom = getStyles(nextButton, ["opacity", "transform", "pointerEvents"], false);
    removeStyleProps(nextButton, Object.keys(nextButtonFrom));
    nextButton.animate([nextButtonFrom, {}], { duration, easing });

    const controlButtonsFrom = getStyles(controlButtons, ["gridTemplateColumns", "gap"], false);
    removeStyleProps(controlButtons, Object.keys(controlButtonsFrom));
    controlButtons.animate([controlButtonsFrom, {}], { duration, easing });

    const nextButtonContainerAnim = nextButtonContainer.animate(
      [{ minWidth: "0px" }, { minWidth: `${nextButton.offsetWidth}px` }],
      { duration, easing }
    );
    nextButtonContainerAnim.onfinish = () => {
      nextButtonContainer.style.removeProperty("min-width");
      nextButtonContainerAnim.onfinish = null;
    };

    return;
  }

  if (state === "page5") {
    for (let i = 0; i < indicators.length; i++) {
      const indicator = indicators[i];
      const anim = indicator.animate([{ transform: "translateY(0)" }, { transform: "translateY(30px)" }], {
        duration: duration - i * 100,
        easing,
        delay: i * 100,
        fill,
      });
      anim.onfinish = () => {
        anim.commitStyles();
        anim.cancel();
        anim.onfinish = null;
      };
    }

    const backButtonBackIconAnim = backButtonBackIcon.animate([{}, { filter: "blur(10px)" }], { duration: duration / 2, easing });
    backButtonBackIconAnim.onfinish = () => {
      backButtonBackIcon.style.display = "none";
      backButtonHomeIcon.style.display = "block";
      backButtonHomeIcon.animate([{ filter: "blur(10px)" }, {}], { duration: duration / 2, easing });
    };

    const controlButtonsAnim = controlButtons.animate([{ gridTemplateColumns: "1fr 0fr", gap: "0" }], { duration, easing, fill });
    controlButtonsAnim.onfinish = () => {
      controlButtons.style.gridTemplateColumns = "1fr 0fr";
      controlButtons.style.gap = "0";
      controlButtonsAnim.cancel();
      controlButtonsAnim.onfinish = null;
    };

    const nextButtonContainerAnim = nextButtonContainer.animate(
      [{ minWidth: `${nextButton.offsetWidth}px` }, { minWidth: "0px" }],
      { duration, easing, fill }
    );
    nextButtonContainerAnim.onfinish = () => {
      nextButtonContainerAnim.commitStyles();
      nextButtonContainerAnim.cancel();
      nextButtonContainerAnim.onfinish = null;
    };

    nextButton.style.removeProperty("display");
    const nextButtonAnim = nextButton.animate(
      [
        { opacity: "1", transform: "translateX(0)" },
        { opacity: "0", transform: "translateX(-150px)", pointerEvents: "none" },
      ],

      { duration, easing, fill }
    );

    nextButtonAnim.onfinish = () => {
      nextButtonAnim.commitStyles();
      nextButtonAnim.cancel();
      nextButtonAnim.onfinish = null;
    };
    return;
  }
}

export function switchInputs(state) {
  const page4InputContainer = document.querySelector(".page-4-inputs");
  const page5InputContainer = document.querySelector(".page-5-inputs");

  if (!page4InputContainer) throw new Error("Couldn't find page-4-inputs");
  if (!page5InputContainer) throw new Error("Couldn't find page-5-inputs");

  if (state === "page4") {
    const page2InputAnim = page5InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(-50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page2InputAnim.onfinish = () => {
      page5InputContainer.style.display = "none";

      page4InputContainer.style.removeProperty("display");
      page4InputContainer.animate(
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

  if (state === "page5") {
    const page1InputAnim = page4InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page1InputAnim.onfinish = () => {
      page4InputContainer.style.display = "none";

      page5InputContainer.style.removeProperty("display");
      page5InputContainer.animate(
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
