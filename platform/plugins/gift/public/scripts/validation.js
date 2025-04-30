const errMsgs = {
  emptyProjectName: "الرجاء ادخال اسم المشروع الذي تبرعت له",
  wrongProjectName: "الرجاء ادخال اسم المشروع الذي تبرعت له بشكل صحيح",

  emptyEmail: "الرجاء ادخال بريدك الالكتروني",
  wrongEmail: "الرجاء ادخال بريدك الالكتروني بشكل صحيح",

  emptyDonorName: "الرجاء ادخال اسم مرسل الاهداء",
  wrongDonorName: "الرجاء ادخال اسم مرسل الاهداء بشكل صحيح",

  emptyDonorPhoneNumber: "الرجاء ادخال رقم هاتف مرسل الاهداء",
  wrongDonorPhoneNumber: "الرجاء إدخال رقم هاتف مرسل الاهداء بصيغة صحيحة تبدأ بـ 965",

  emptyRecipientName: "الرجاء ادخال اسم مستلم الاهداء",
  wrongRecipientName: "الرجاء ادخال اسم مستلم الاهداء بشكل صحيح",

  emptyRecipientPhoneNumber: "الرجاء ادخال رقم هاتف مستلم الاهداء",
  wrongRecipientPhoneNumber: "الرجاء إدخال رقم هاتف مستلم الإهداء بصيغة صحيحة تبدأ بـ 965",
};

const mailRe = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
const phoneRe = /^965[0-9]{8}$/;

export function validateProjectName(projectName) {
  if (!projectName) {
    return { ok: false, errMsg: errMsgs.emptyProjectName };
  }
  if (projectName.length < 3) {
    return { ok: false, errMsg: errMsgs.wrongProjectName };
  }
  return { ok: true, errMsg: null };
}

export function ValidateEmail(mail) {
  if (!mail) {
    return { ok: false, errMsg: errMsgs.emptyEmail };
  }
  if (!mailRe.test(mail)) {
    return { ok: false, errMsg: errMsgs.wrongEmail };
  }
  return { ok: true, errMsg: null };
}

export function validateDonorName(senderName) {
  if (!senderName) {
    return { ok: false, errMsg: errMsgs.emptyDonorName };
  }
  if (senderName.length < 3) {
    return { ok: false, errMsg: errMsgs.wrongDonorName };
  }
  return { ok: true, errMsg: null };
}

export function validateDonorPhoneNumber(senderPhoneNumber) {
  // if (!senderPhoneNumber) {
  //   return { ok: false, errMsg: errMsgs.emptyDonorPhoneNumber };
  // }
  // if (!phoneRe.test(senderPhoneNumber)) {
  //   return { ok: false, errMsg: errMsgs.wrongDonorPhoneNumber };
  // }
  return { ok: true, errMsg: null };
}

export function validateRecipientName(recipientName) {
  if (!recipientName) {
    return { ok: false, errMsg: errMsgs.emptyRecipientName };
  }
  if (recipientName.length < 3) {
    return { ok: false, errMsg: errMsgs.wrongRecipientName };
  }
  return { ok: true, errMsg: null };
}

export function validateRecipientPhoneNumber(recipientPhoneNumber) {
  // if (!recipientPhoneNumber) {
  //   return { ok: false, errMsg: errMsgs.emptyRecipientPhoneNumber };
  // }
  // if (!phoneRe.test(recipientPhoneNumber)) {
  //   return { ok: false, errMsg: errMsgs.wrongRecipientPhoneNumber };
  // }
  return { ok: true, errMsg: null };
}
