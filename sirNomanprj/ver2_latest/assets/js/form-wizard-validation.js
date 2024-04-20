"use strict";
! function() {
    const e = $(".select2"),
        a = $(".selectpicker"),
        i = document.querySelector("#wizard-validation");
    if (void 0 !== typeof i && null !== i) {
        const t = i.querySelector("#wizard-validation-form"),
            o = t.querySelector("#account-details-validation"),
            n = t.querySelector("#personal-info-validation"),
            r = t.querySelector("#social-links-validation"),
            s = [].slice.call(t.querySelectorAll(".btn-next")),
            l = [].slice.call(t.querySelectorAll(".btn-prev")),
            d = new Stepper(i, {
                linear: !0
            }),
            m = FormValidation.formValidation(o, {
                fields: {
                    release_name: {
                        validators: {
                            notEmpty: {
                                message: "Release name is required"
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: "This name must be more than 6 and less than 30 characters long"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9 ]+$/,
                                message: "The name can only consist of alphabetical, number and space"
                            }
                        }
                    },
                    catalog_no: {
                        validators: {
                            notEmpty: {
                                message: "Catalog no. is required"
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: "Must be more than 6 and less than 30 characters long"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9 ]+$/,
                                message: "The name can only consist of alphabetical, number and space"
                            }
                        }
                    },
                    // upc: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "UPC is required"
                    //         },
                    //         stringLength: {
                    //             min: 6,
                    //             max: 30,
                    //             message: "Must be more than 6 and less than 30 characters long"
                    //         },
                    //         regexp: {
                    //             regexp: /^[a-zA-Z0-9 ]+$/,
                    //             message: "The name can only consist of alphabetical, number and space"
                    //         }
                    //     }
                    // },
                    // compilation: {
                    //     validators: {
                    //         choice: {
                    //             min: 1,
                    //             message: 'Please choose an option',
                    //         },
                    //     },
                    // },
                    // no_of_tracks: {
                    //     validators: {
                    //         integer: {
                    //             message: 'The value is not an integer',
                    //             // The default separators
                    //             thousandsSeparator: '',
                    //             decimalSeparator: '.',
                    //         },
                    //     },  
                    // },
                    // label_name: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Please choose an option',
                    //         },
                    //     },  
                    // },
                    // main_genre: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Please choose an option'
                    //         },
                    //         // stringLength: {
                    //         //     min: 6,
                    //         //     max: 30,
                    //         //     message: "This name must be more than 6 and less than 30 characters long"
                    //         // },
                    //         // regexp: {
                    //         //     regexp: /^[a-zA-Z0-9 ]+$/,
                    //         //     message: "The name can only consist of alphabetical, number and space"
                    //         // }
                    //     }
                    // },
                    // sub_genre: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Please choose an option'
                    //         }
                    //         // stringLength: {
                    //         //     min: 6,
                    //         //     max: 30,
                    //         //     message: "This name must be more than 6 and less than 30 characters long"
                    //         // },
                    //         // regexp: {
                    //         //     regexp: /^[a-zA-Z0-9 ]+$/,
                    //         //     message: "The name can only consist of alphabetical, number and space"
                    //         // }
                    //     }
                    // },
                    // pricing_tier: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "This field is required"
                    //         },
                    //         stringLength: {
                    //             min: 1,
                    //             max: 30,
                    //             message: "Text must be more than 1 and less than 30 characters long"
                    //         },
                           
                    //     }
                    // },
                    // pline: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "This field is required"
                    //         },
                    //         stringLength: {
                    //             min: 6,
                    //             max: 30,
                    //             message: "This name must be more than 6 and less than 30 characters long"
                    //         },
                    //         regexp: {
                    //             regexp: /^[a-zA-Z0-9 ]+$/,
                    //             message: "The name can only consist of alphabetical, number and space"
                    //         }
                    //     }
                    // },
                    // cline: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "This field is required"
                    //         },
                    //         stringLength: {
                    //             min: 6,
                    //             max: 30,
                    //             message: "This name must be more than 6 and less than 30 characters long"
                    //         },
                    //         regexp: {
                    //             regexp: /^[a-zA-Z0-9 ]+$/,
                    //             message: "The name can only consist of alphabetical, number and space"
                    //         }
                    //     }
                    // },
                    // languages_meta: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "This field is required"
                    //         },
                            
                    //     }
                    // },
                  
                  
                  
                  
                    // formValidationEmail: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The Email is required"
                    //         },
                    //         emailAddress: {
                    //             message: "The value is not a valid email address"
                    //         }
                    //     }
                    // },
                    // formValidationPass: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The password is required"
                    //         }
                    //     }
                    // },
                    // formValidationConfirmPass: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The Confirm Password is required"
                    //         },
                    //         identical: {
                    //             compare: function() {
                    //                 return o.querySelector('[name="formValidationPass"]').value
                    //             },
                    //             message: "The password and its confirm are not the same"
                    //         }
                    //     }
                    // },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                },
                init: e => {
                    e.on("plugins.message.placed", (function(e) {
                        e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
                    }))
                }
            }).on("core.form.valid", (function() {
                d.next()
            })),
            u = FormValidation.formValidation(n, {
                fields: {
                    'track_song_name[]': {
                        validators: {
                            notEmpty: {
                                message: 'Please choose 2 - 4 programming languages you are good at',
                            },
                        },
                        
                    },
                  
                  
                  
                    // formValidationFirstName: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The first name is required"
                    //         }
                    //     }
                    // },
                    // formValidationLastName: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The last name is required"
                    //         }
                    //     }
                    // },
                    // formValidationCountry: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The Country is required"
                    //         }
                    //     }
                    // },
                    // formValidationLanguage: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "The Languages is required"
                    //         }
                    //     }
                    // }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                }
            }).on("core.form.valid", (function() {
                d.next()
            }));
        a.length && a.each((function() {
            $(this).selectpicker().on("change", (function() {
                u.revalidateField("formValidationLanguage")
            }))
        })), e.length && e.each((function() {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>'), e.select2({
                placeholder: "Select an country",
                dropdownParent: e.parent()
            }).on("change.select2", (function() {
                u.revalidateField("formValidationCountry")
            }))
        }));
        const c = FormValidation.formValidation(r, {
            fields: {
                // formValidationTwitter: {
                //     validators: {
                //         notEmpty: {
                //             message: "The Twitter URL is required"
                //         },
                //         uri: {
                //             message: "The URL is not proper"
                //         }
                //     }
                // },
                // formValidationFacebook: {
                //     validators: {
                //         notEmpty: {
                //             message: "The Facebook URL is required"
                //         },
                //         uri: {
                //             message: "The URL is not proper"
                //         }
                //     }
                // },
                // formValidationGoogle: {
                //     validators: {
                //         notEmpty: {
                //             message: "The Google URL is required"
                //         },
                //         uri: {
                //             message: "The URL is not proper"
                //         }
                //     }
                // },
                // formValidationLinkedIn: {
                //     validators: {
                //         notEmpty: {
                //             message: "The LinkedIn URL is required"
                //         },
                //         uri: {
                //             message: "The URL is not proper"
                //         }
                //     }
                // }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger,
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-6"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus,
                submitButton: new FormValidation.plugins.SubmitButton
            }
        }).on("core.form.valid", (function() {
            //   $(".loader").removeClass("d-none");
            $('#wizard-validation-form').attr('onSubmit', '');
            $('#wizard-validation-form').submit();
            
            
            console.log("Submitted..!!");
        }));
        s.forEach((e => {
            e.addEventListener("click", (e => {
                switch (d._currentIndex) {
                    case 0:
                        m.validate();
                        break;
                    case 1:
                        u.validate();
                        break;
                    case 2:
                        c.validate()
                }
            }))
        })), l.forEach((e => {
            e.addEventListener("click", (e => {
                switch (d._currentIndex) {
                    case 2:
                    case 1:
                        d.previous()
                }
            }))
        }))
    }
}();