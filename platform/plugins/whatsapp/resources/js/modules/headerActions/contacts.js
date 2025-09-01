import { ref, get, update, remove } from "firebase/database";

import { db } from "./../firebase";

import { sanitizeKey } from "./../helpers.js";

class Contacts {
    init() {
        this.getContacts();

        $(document).on("click", ".edit_contact", (e) => this.openEditModal(e));
        $(document).on("click", "#EditContact", () => this.editContact());
        $(document).on("click", "#DeleteContact", (e) => this.deleteContact(e));
    }

    // ✅ Fetch all contacts from RTDB
    getContacts() {
        $("#contactsResults").empty();
        $("#spinner").show();

        const contactsRef = ref(db, "whatsapp_contacts");

        get(contactsRef).then((snapshot) => {
            const data = snapshot.val() || {};
            Object.keys(data).forEach((key) => {
                const contact = data[key];
                $("#contactsResults").append(`
            <tr>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li class="avatar avatar-xs pull-up">
                    <img src="${contact.display}" alt="Avatar" style="width: 49px;" class="rounded-circle"/>
                  </li>
                </ul>
              </td>
              <td><strong>${contact.name || ""}</strong></td>
              <td>${contact.channel || ""}</td>
              <td>${contact.email || ""}</td>
              <td>${contact.phone || ""}</td>
              <td>${contact.tags || ""}</td>
              <td>${contact.country || ""}</td>
              <td>${contact.language || ""}</td>
              <td><span class="badge bg-label-primary me-1">${contact.conversation_status || "open"}</span></td>
              <td>${contact.assignee || ""}</td>
              <td>${contact.last_message || ""}</td>
              <td>${contact.date_added || ""}</td>
              <td class="text-end">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow">
                        <a class="dropdown-item d-flex align-items-center edit_contact" data-id="${contact.id}" href="javascript:void(0);">
                            <i class="bi bi-pencil me-2"></i> Edit
                        </a>
                        <a class="dropdown-item d-flex align-items-center" data-id="${contact.id}" href="javascript:void(0);">
                            <i class="bi bi-chat-dots me-2"></i> View Messages
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center text-danger"  id="DeleteContact"  data-id="${contact.id}" href="javascript:void(0);">
                            <i class="bi bi-trash me-2"></i> Delete
                        </a>
                    </div>
                </div>
            </td>

            </tr>
          `);
            });
            $("#spinner").hide();
        });
    }

    // ✅ Open edit modal
    openEditModal(e) {
        $("#spinner").show();
        const sanitizedId = sanitizeKey($(e.currentTarget).data("id"));
        const contactRef = ref(db, "whatsapp_contacts/" + sanitizedId);

        get(contactRef).then((snapshot) => {
            const contact = snapshot.val();
            if (contact) {
                $("#id").val(contact.id);
                $("#name").val(contact.name);
                $("#channel").val(contact.channel);
                $("#email").val(contact.email);
                $("#phone").val(contact.phone);
                $("#tags").val(contact.tags);
                $("#country").val(contact.country);
                $("#language").val(contact.language);
                $("#conversation_status").val(contact.conversation_status);
                $("#assignee").val(contact.assignee);
                $("#EditModal").modal("show");
            }
            $("#spinner").hide();
        });
    }

    // ✅ Save edits back to RTDB
    editContact() {
        $("#spinner").show();
        const sanitizedId = sanitizeKey($("#id").val());

        const updatedData = {
            name: $("#name").val(),
            channel: $("#channel").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            tags: $("#tags").val(),
            country: $("#country").val(),
            language: $("#language").val(),
            conversation_status: $("#conversation_status").val(),
            assignee: $("#assignee").val(),
        };

        const contactRef = ref(db, "whatsapp_contacts/" + sanitizedId);
        // const contactRef = ref(db, "whatsapp_contacts/" + id);

        update(contactRef, updatedData)
            .then(() => {
                $("#EditModal").modal("hide");
                $(".alert-success").text("Contact updated successfully").show();
                setTimeout(() => $(".alert-success").hide(), 3000);
                this.getContacts();
            })
            .catch(() => {
                $(".alert-danger").text("Failed to update contact").show();
                setTimeout(() => $(".alert-danger").hide(), 3000);
            })
            .finally(() => $("#spinner").hide());
    }

    // ✅ Delete contact
    deleteContact(e) {
        $("#spinner").show();
        const sanitizedId = sanitizeKey($(e.currentTarget).data("id"));
        const contactRef = ref(db, "whatsapp_contacts/" + sanitizedId);

        remove(contactRef)
            .then(() => this.getContacts())
            .catch(() => {
                $(".alert-danger").text("Failed to delete contact").show();
                setTimeout(() => $(".alert-danger").hide(), 3000);
            })
            .finally(() => $("#spinner").hide());
    }
}

$(function () {
    new Contacts().init();
});
