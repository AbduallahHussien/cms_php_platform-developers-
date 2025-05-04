import * as page_1 from "./page_1.js";
import * as page_2 from "./page_2.js";
import * as page_3 from "./page_3.js";
import * as page_4 from "./page_4.js";
import {
  changeMainButtonLabel,
  clearValidationMessage,
  duration,
  setGiftTagText,
  setPageIndicator,
  templateBtnHandler,
} from "./utils.js";

import {
  validateDonorName,
  validateDonorPhoneNumber,
  ValidateEmail,
  validateProjectName,
  validateRecipientName,
  validateRecipientPhoneNumber,
} from "./validation.js";

// - Send

async function send() {
  // - collect input values

  const projectNameInput = document.querySelector("#project-name");
  const emailInput = document.querySelector("#email");
  const donorNameInput = document.querySelector("#donor-name");
  const donorPhoneInput = document.querySelector("#donor-phone");
  const recipientNameInput = document.querySelector("#recipient-name");
  const recipientPhoneInput = document.querySelector("#recipient-phone");
  const selectedTemplateBtn = document.querySelector(".template-btn.selected");

  if (!projectNameInput || !emailInput || !donorNameInput || !donorPhoneInput || !recipientNameInput || !recipientPhoneInput) {
    throw new Error("Couldn't find input elements");
  }

  const defaultTemplateName = "0";
  const messageTemplateName = selectedTemplateBtn?.dataset?.index ?? defaultTemplateName;

  const data = {
    projectName: projectNameInput.value,
    email: emailInput.value,
    donorName: donorNameInput.value,
    donorPhone: donorPhoneInput.value,
    recipientName: recipientNameInput.value,
    recipientPhone: recipientPhoneInput.value,
    messageTemplate: messageTemplateName,
  };

 
  $.ajax({
    url: routePost,
    type: "POST",
    data: data,
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    success: function(response) {
        console.log(response);
    },
    error: function(xhr) {
        console.log(xhr.responseJSON);

    }
});
  // - submit 
}

// - Next/Back handlers

// - For debugging
const forceValidation = true;

let currentPage = 1;
let isButtonsDisabled = false;
let timeoutRef = 0;

function nextHandler() {
  const nextButton = document.querySelector("#next-button");
  if (!nextButton) throw new Error("Couldn't find next-button");

  if (isButtonsDisabled) return;

  clearTimeout(timeoutRef);
  isButtonsDisabled = true;
  timeoutRef = setTimeout(() => (isButtonsDisabled = false), duration);

  if (currentPage === 1) {
    const projectNameInput = document.querySelector("#project-name");
    const emailInput = document.querySelector("#email");
    if (!projectNameInput || !emailInput) throw new Error("Couldn't find page_1 inputs");

    const projectNameValidation = validateProjectName(projectNameInput.value);
    if (!projectNameValidation.ok) {
      projectNameInput.setCustomValidity(projectNameValidation.errMsg);
      projectNameInput.reportValidity();
      if (forceValidation) return;
    }

    const emailValidation = ValidateEmail(emailInput.value);
    if (!emailValidation.ok) {
      emailInput.setCustomValidity(emailValidation.errMsg);
      emailInput.reportValidity();
      if (forceValidation) return;
    }

    projectNameInput.blur();
    emailInput.blur();
    nextFrom1to2();
    currentPage = 2;
    return;
  }

  if (currentPage === 2) {
    const donorNameInput = document.querySelector("#donor-name");
    const donorPhoneInput = document.querySelector("#donor-phone");
    if (!donorNameInput || !donorPhoneInput) throw new Error("Couldn't find page_2 inputs");

    const donorNameValidation = validateDonorName(donorNameInput.value);
    if (!donorNameValidation.ok) {
      donorNameInput.setCustomValidity(donorNameValidation.errMsg);
      donorNameInput.reportValidity();
      if (forceValidation) return;
    }

    const donorPhoneValidation = validateDonorPhoneNumber(donorPhoneInput.value);
    if (!donorPhoneValidation.ok) {
      donorPhoneInput.setCustomValidity(donorPhoneValidation.errMsg);
      donorPhoneInput.reportValidity();
      if (forceValidation) return;
    }

    donorNameInput.blur();
    donorPhoneInput.blur();
    nextFrom2to3();
    currentPage = 3;
    return;
  }

  if (currentPage === 3) {
    const recipientNameInput = document.querySelector("#recipient-name");
    const recipientPhoneInput = document.querySelector("#recipient-phone");
    if (!recipientNameInput || !recipientPhoneInput) throw new Error("Couldn't find page_3 inputs");

    const recipientNameValidation = validateRecipientName(recipientNameInput.value);
    if (!recipientNameValidation.ok) {
      recipientNameInput.setCustomValidity(recipientNameValidation.errMsg);
      recipientNameInput.reportValidity();
      if (forceValidation) return;
    }

    const recipientPhoneValidation = validateRecipientPhoneNumber(recipientPhoneInput.value);
    if (!recipientPhoneValidation.ok) {
      recipientPhoneInput.setCustomValidity(recipientPhoneValidation.errMsg);
      recipientPhoneInput.reportValidity();
      if (forceValidation) return;
    }

    recipientNameInput.blur();
    recipientPhoneInput.blur();
    nextFrom3to4();
    currentPage = 4;
    return;
  }

  if (currentPage === 4) {
    send();
    nextFrom4to5();
    currentPage = 5;
    return;
  }
}

function backHandler() {
  const backButton = document.querySelector("#back-button");
  if (!backButton) throw new Error("Couldn't find back-button");

  if (isButtonsDisabled) return;

  clearTimeout(timeoutRef);
  isButtonsDisabled = true;
  timeoutRef = setTimeout(() => (isButtonsDisabled = false), duration);

  if (currentPage === 2) {
    backFrom2to1();
    currentPage = 1;
    return;
  }

  if (currentPage === 3) {
    backFrom3to2();
    currentPage = 2;
    return;
  }

  if (currentPage === 4) {
    backFrom4to3();
    currentPage = 3;
    return;
  }

  // - Last page (back button is now a home button)
  if (currentPage === 5) {
    window.location.reload();
    return;
  }
}

// - Navigation helpers

function nextFrom1to2() {
  changeMainButtonLabel("التالي");
  page_1.welcomeTxtAnimation("page2");
  page_1.headerAnimation("page2");
  page_1.backButtonAnimation("page2");
  page_1.pageIndicatorAnimation("page2");
  page_1.switchInputs("page2");
  page_1.giftAnimation("page2");
  page_1.topLayerAnimation("page2");
}

function backFrom2to1() {
  changeMainButtonLabel("البدأ");
  page_1.welcomeTxtAnimation("page1");
  page_1.headerAnimation("page1");
  page_1.backButtonAnimation("page1");
  page_1.pageIndicatorAnimation("page1");
  page_1.switchInputs("page1");
  page_1.giftAnimation("page1");
  page_1.topLayerAnimation("page1");
}

function nextFrom2to3() {
  setPageIndicator("third");
  page_2.giftAnimation("page3");
  page_2.switchInputs("page3");
}

function backFrom3to2() {
  setPageIndicator("second");
  page_2.giftAnimation("page2");
  page_2.switchInputs("page2");
}

function nextFrom3to4() {
  changeMainButtonLabel("إنهاء");
  setPageIndicator("fourth");
  page_3.giftAnimation("page4");
  page_3.switchInputs("page4");
}

function backFrom4to3() {
  changeMainButtonLabel("التالي");
  setPageIndicator("third");
  page_3.giftAnimation("page3");
  page_3.switchInputs("page3");
}

function nextFrom4to5() {
  page_4.imgAnimation("page5");
  page_4.controlsAnimation("page5");
  page_4.switchInputs("page5");
}

// - Attach events

const nextButton = document.querySelector("#next-button");
if (!nextButton) throw new Error("Couldn't find next-button");
nextButton.addEventListener("click", nextHandler);

const backButton = document.querySelector("#back-button");
if (!backButton) throw new Error("Couldn't find back-button");
backButton.addEventListener("click", backHandler);

const recipientNameInput = document.querySelector("#recipient-name");
if (recipientNameInput) {
  recipientNameInput.addEventListener("input", () => {
    setGiftTagText(recipientNameInput.value);
  });
}

document.querySelectorAll("input").forEach(e => {
  e.addEventListener("input", clearValidationMessage);
});

document.querySelectorAll(".template-btn").forEach(e => {
  e.addEventListener("click", templateBtnHandler);
});
