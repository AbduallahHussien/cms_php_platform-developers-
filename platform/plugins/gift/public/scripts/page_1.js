import { carryingHandOnResize, duration, easing, getStyles, removeStyleProps } from "./utils.js";

const fill = "forwards";

export function backButtonAnimation(state) {
  const contentContainer = document.querySelector(".content");
  const backButton = document.querySelector("#back-button");
  const backButtonContainer = backButton?.parentElement;
  const controlButtons = document.querySelector(".controls-buttons");

  if (!contentContainer) throw new Error("Couldn't find content-container");
  if (!backButton) throw new Error("Couldn't find back-button");
  if (!backButtonContainer) throw new Error("Couldn't find back-button-container");
  if (!controlButtons) throw new Error("Couldn't find control-buttons");

  if (state === "page1") {
    const controlButtonsAnim = controlButtons.animate([{ gridTemplateColumns: "0fr 1fr", gap: "0" }], { duration, easing, fill });
    controlButtonsAnim.onfinish = () => {
      controlButtons.style.gridTemplateColumns = "0fr 1fr";
      controlButtons.style.gap = "0";
      controlButtonsAnim.cancel();
      controlButtonsAnim.onfinish = null;
    };

    const backButtonContainerAnim = backButtonContainer.animate(
      [{ minWidth: `${backButton.offsetWidth}px` }, { minWidth: "0px" }],
      { duration, easing, fill }
    );
    backButtonContainerAnim.onfinish = () => {
      backButtonContainerAnim.commitStyles();
      backButtonContainerAnim.cancel();
      backButtonContainerAnim.onfinish = null;
    };

    backButton.style.removeProperty("display");
    const backButtonAnim = backButton.animate(
      [
        { opacity: "1", transform: "translateX(0)" },
        { opacity: "0", transform: "translateX(150px)" },
      ],

      { duration, easing }
    );

    backButtonAnim.onfinish = () => {
      backButton.style.display = "none";
      backButtonAnim.onfinish = null;
    };

    return;
  }

  if (state === "page2") {
    backButton.style.removeProperty("display");
    backButton.animate(
      [
        { opacity: "0", transform: "translateX(150px)" },
        { opacity: "1", transform: "translateX(0)" },
      ],

      { duration, easing }
    );

    const controlButtonsFrom = getStyles(controlButtons, ["gridTemplateColumns", "gap"], false);
    removeStyleProps(controlButtons, Object.keys(controlButtonsFrom));
    controlButtons.animate([controlButtonsFrom, {}], { duration, easing });

    const backButtonContainerAnim = backButtonContainer.animate(
      [{ minWidth: "0px" }, { minWidth: `${backButton.offsetWidth}px` }],
      { duration, easing }
    );
    backButtonContainerAnim.onfinish = () => {
      backButtonContainer.style.removeProperty("min-width");
      backButtonContainerAnim.onfinish = null;
    };

    return;
  }
}

export function headerAnimation(state) {
  const header = document.querySelector(".header");
  if (!header) throw new Error("Couldn't find header");

  const logoTxt = document.querySelector(".logo-text");
  if (!logoTxt) throw new Error("Couldn't find logo-text");

  if (state === "page1") {
    const fromStyle = getStyles(header, ["backgroundColor", "paddingTop"], false);
    removeStyleProps(header, Object.keys(fromStyle));
    header.animate([fromStyle, {}], { duration, easing: "ease" });

    const logoTxtFromStyle = getStyles(logoTxt, ["marginTop"], false);
    removeStyleProps(logoTxt, Object.keys(logoTxtFromStyle));
    logoTxt.animate([logoTxtFromStyle, {}], { duration, easing: "ease" });

    return;
  }

  if (state === "page2") {
    const hideHeaderAnim = header.animate([{}, { backgroundColor: "#0000", boxShadow: "none", paddingTop: "0px" }], {
      duration,
      easing,
      fill,
    });
    hideHeaderAnim.onfinish = () => {
      hideHeaderAnim.commitStyles();
      hideHeaderAnim.cancel();
      hideHeaderAnim.onfinish = null;
    };

    const logoTxtAnim = logoTxt.animate([{}, { marginTop: "0px" }], { duration, easing, fill });
    logoTxtAnim.onfinish = () => {
      logoTxtAnim.commitStyles();
      logoTxtAnim.cancel();
      logoTxtAnim.onfinish = null;
    };
    return;
  }
}

export function welcomeTxtAnimation(state) {
  const txt = document.querySelector(".page-1-txt");
  const bg = document.querySelector(".page-1-bg");
  const giftContainer = document.querySelector(".gift-container");

  if (!giftContainer) throw new Error("Couldn't find gift-container");
  if (!txt) throw new Error("Couldn't find page-1-txt");
  if (!bg) throw new Error("Couldn't find page-1-bg");

  if (state === "page1") {
    txt.style.removeProperty("display");
    const txtFromStyle = getStyles(txt, ["opacity", "height", "marginTop", "visibility", "flex"], false);
    removeStyleProps(txt, Object.keys(txtFromStyle));
    const txtToStyle = getStyles(txt, ["opacity", "height", "marginTop"], true);
    txt.animate([txtFromStyle, Object.assign(txtToStyle, { marginBottom: `${giftContainer.offsetHeight}px` })], {
      duration,
      easing,
    });

    removeStyleProps(bg, ["opacity", "inset", "visibility"]);
    bg.animate(
      [
        { opacity: "0", inset: "0 0 100%" },
        { opacity: "1", inset: "0 0 60px" },
      ],

      { duration, easing: "ease" }
    );
    return;
  }

  if (state === "page2") {
    const txtFromStyle = getStyles(txt, ["opacity", "height", "marginTop", "flex"]);
    const hideTxtAnim = txt.animate(
      [
        Object.assign(txtFromStyle, { marginBottom: `${giftContainer.offsetHeight}px` }),
        { flex: "0", opacity: "0", height: "0px", marginTop: "0", visibility: "hidden" },
      ],

      { duration, easing, fill }
    );
    hideTxtAnim.onfinish = () => {
      hideTxtAnim.commitStyles();
      hideTxtAnim.cancel();
      txt.style.display = "none";
      hideTxtAnim.onfinish = null;
    };

    const hideBgAnim = bg.animate([{}, { opacity: "0", inset: "0 0 100%" }], { duration, easing: "ease", fill });
    hideBgAnim.onfinish = () => {
      hideBgAnim.commitStyles();
      hideBgAnim.cancel();
      hideBgAnim.onfinish = null;
    };

    return;
  }
}

export function pageIndicatorAnimation(state) {
  const indicators = document.querySelectorAll(".page-indicator");
  if (!indicators.length) throw new Error("Couldn't find page-indicator");

  if (state === "page1") {
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
    return;
  }

  if (state === "page2") {
    for (let i = 0; i < indicators.length; i++) {
      const indicator = indicators[i];
      const fromStyle = getStyles(indicator, ["transform"], false);
      setTimeout(() => {
        removeStyleProps(indicator, Object.keys(fromStyle));
        indicator.animate([fromStyle, { transform: "translateY(0)" }], { duration: duration - i * 100, easing });
      }, i * 100);
    }
    return;
  }
}

export function switchInputs(state) {
  const page1InputContainer = document.querySelector(".page-1-inputs");
  const page2InputContainer = document.querySelector(".page-2-inputs");

  if (!page1InputContainer) throw new Error("Couldn't find page-1-inputs");
  if (!page2InputContainer) throw new Error("Couldn't find page-2-inputs");

  if (state === "page1") {
    const page2InputAnim = page2InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(-50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page2InputAnim.onfinish = () => {
      page2InputContainer.style.display = "none";

      page1InputContainer.style.removeProperty("display");
      page1InputContainer.animate(
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

  if (state === "page2") {
    const page1InputAnim = page1InputContainer.animate([{ opacity: "1" }, { opacity: "0", transform: "translateX(50%)" }], {
      duration: duration * 0.25,
      easing,
    });

    page1InputAnim.onfinish = () => {
      page1InputContainer.style.display = "none";

      page2InputContainer.style.removeProperty("display");
      page2InputContainer.animate(
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

export function giftAnimation(state) {
  const contentContainer = document.querySelector(".content");
  if (!contentContainer) throw new Error("Couldn't find content-container");

  const giftContainer = document.querySelector(".gift-container");
  if (!giftContainer) throw new Error("Couldn't find gift-container");

  const ribbon = giftContainer.querySelector(".gift-ribbon");
  if (!ribbon) throw new Error("Couldn't find gift-ribbon");

  const carryingHand = document.querySelector(".carrying-hand");
  if (!carryingHand) throw new Error("Couldn't find carrying-hand");

  if (state === "page1") {
    giftContainer.style.removeProperty("transform");
    contentContainer.style.removeProperty("justify-content");
    giftContainer.animate(
      [
        { position: "absolute", bottom: "50%", left: "50%", transform: "scale(1.2)", translate: "-50% 50%" },
        { position: "absolute", bottom: "0", left: "50%", transform: "scale(1)", translate: "-50% 0" },
      ],

      { duration, easing }
    );

    const ribbonFrom = getStyles(ribbon, ["transform"], false);
    removeStyleProps(ribbon, Object.keys(ribbonFrom));
    ribbon.animate([ribbonFrom, {}], { duration, easing });

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

  if (state === "page2") {
    contentContainer.style.justifyContent = "flex-start";

    const giftAnim = giftContainer.animate(
      [
        { position: "absolute", bottom: "0", left: "50%", transform: "scale(1)", translate: "-50% 0" },
        { position: "absolute", bottom: "50%", left: "50%", transform: "scale(1.2)", translate: "-50% 50%" },
      ],

      { duration, easing }
    );
    giftAnim.onfinish = () => {
      contentContainer.style.justifyContent = "center";
      giftContainer.style.transform = `scale(1.2)`;
      giftAnim.onfinish = null;
    };

    const ribbonAnim = ribbon.animate([{ transform: "translateY(0)" }, { transform: "translateY(10px)" }], {
      duration,
      easing: "ease",
      fill,
    });

    ribbonAnim.onfinish = () => {
      ribbonAnim.commitStyles();
      ribbonAnim.cancel();
      ribbonAnim.onfinish = null;
    };

    const startTime = performance.now();
    function checkPosition() {
      const rect = giftContainer.getBoundingClientRect();
      carryingHand.style.top = `calc(${rect.bottom + scrollY - carryingHand.offsetHeight * 0.8}px)`;
      if (performance.now() - startTime < duration) {
        requestAnimationFrame(checkPosition);
      }
    }
    checkPosition();

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
}

export function topLayerAnimation(state) {
  const topLayer = document.querySelector(".top-layer");
  if (!topLayer) throw new Error("Couldn't find top-layer");

  if (state === "page1") {
    const topLayerFrom = getStyles(topLayer, ["opacity"], false);
    removeStyleProps(topLayer, Object.keys(topLayerFrom));
    topLayer.animate([{ opacity: "1" }, { opacity: "0" }], { duration, easing: "cubic-bezier(0.33, 1, 0.68, 1)", fill });
    return;
  }

  if (state === "page2") {
    const topLayerAnim = topLayer.animate([{ opacity: "0" }, { opacity: "1" }], {
      duration,
      easing: "cubic-bezier(0.32, 0, 0.67, 0)",
      fill,
    });

    topLayerAnim.onfinish = () => {
      topLayerAnim.commitStyles();
      topLayerAnim.cancel();
      topLayerAnim.onfinish = null;
    };
    return;
  }
}
