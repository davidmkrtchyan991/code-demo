$(document).ready(function () {
    setCSRFToken();

    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };

    let next = 1;
    $(".add-more").click(function (e) {
        e.preventDefault();
        let addto = "#field" + next;
        let addRemove = "#field" + (next);
        next = next + 1;
        let newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="prop[]" type="text">';
        let newInput = $(newIn);
        let removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        let removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source', $(addto).attr('data-source'));
        $("#count").val(next);

        $('.remove-me').click(function (e) {
            e.preventDefault();
            let fieldNum = this.id.charAt(this.id.length - 1);
            let fieldID = "#field" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
        });
    });

    $(".add-more-exceptional").click(function (e) {
        e.preventDefault();
        let addto = "#field" + next;
        let addRemove = "#field" + (next);
        next = next + 1;
        let newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="exceptional-items[]" type="text">';
        let newInput = $(newIn);
        let removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        let removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source', $(addto).attr('data-source'));
        $("#count").val(next);

        $('.remove-me').click(function (e) {
            e.preventDefault();
            let fieldNum = this.id.charAt(this.id.length - 1);
            let fieldID = "#field" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
        });
    });


    let userPassFields = '<div class="form-group{{ $errors->has(\'password\') ? \' has-error\' : \'\' }}">\n' +
        '            <label for="password" class="col-md-4 control-label">Пароль</label>\n' +
        '\n' +
        '            <div class="col-md-6">\n' +
        '                <input id="password" type="password" class="form-control" name="password">\n' +
        '\n' +
        '            </div>\n' +
        '        </div>\n' +
        '\n' +
        '        <div class="form-group">\n' +
        '            <label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>\n' +
        '\n' +
        '            <div class="col-md-6">\n' +
        '                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">\n' +
        '            </div>\n' +
        '        </div>';

    let changeUserPassBlock = $(".changeUserPassFieldsBlock");
    let changeUserPassBtn = $(".changeUserPassFieldsBtn");
    changeUserPassBtn.click(function () {
        if ($(this).hasClass("active")) {
            changeUserPassBtn.removeClass("active").text("Изменение пароля");
            changeUserPassBlock.empty();
        } else {
            changeUserPassBtn.addClass("active").text("Отменить изменение пароля");
            changeUserPassBlock.append(userPassFields);
        }
    });


    /* Get order topvisor positions*/
    function getOrderPositions() {
        if ($("#order").attr('data-order-domain')) {
            let currentDomain = $("#order").data('order-domain');
            let currentDomainId = $("#order").data('order-domain-id');
            $(".api-spinner").show();
            $.ajax({
                type: "POST",
                url: '/getapi',
                data: {
                    domain: currentDomain,
                    domainiId: currentDomainId
                },
                success: function (data) {
                    fillInPositionsForOrder(data);
                },
                error: function () {
                    console.log("Error occured");
                },
                complete: function () {
                    console.log('already completed');
                }
            });
        }
    }
    getOrderPositions();

    function fillInPositionsForOrderById(data) {
        // $('.tile_count').show();

        console.log(data);

    }
    /* Get order topvisor positions */

    function fillInPositionsForOrder(data) {
        $(".api-spinner").hide();
        $('.tile_count.statistic-for-order').show();
        let summaryKeys = Object.keys(data.positions_summary.tops[1]);
        let summaryDynamicsKeys = Object.keys(data.positions_summary.tops_dynamics);
        let first = data.positions_summary.tops[1][summaryKeys[0]];
        let second = data.positions_summary.tops_dynamics[summaryDynamicsKeys[0]];
        let positionSummaryAvg = data.positions_summary.avgs[1];

        let positionSummaryDynamicsAll = data.positions_summary.dynamics.all;
        let positionSummaryDynamicsDown = data.positions_summary.dynamics.down;
        let positionSummaryDynamicsStay = data.positions_summary.dynamics.stay;
        let positionSummaryDynamicsUp = data.positions_summary.dynamics.up;

        let positionSummaryTops1to3 = data.positions_summary.tops[1][summaryKeys[0]];
        let positionSummaryTops1to10 = data.positions_summary.tops[1][summaryKeys[1]];
        let positionSummaryTops11to30 = data.positions_summary.tops[1][summaryKeys[2]];
        let positionSummaryTops31to50 = data.positions_summary.tops[1][summaryKeys[3]];
        let positionSummaryTops51to100 = data.positions_summary.tops[1][summaryKeys[4]];
        let positionSummaryTops101to10000 = data.positions_summary.tops[1][summaryKeys[5]];

        let positionSummaryDynamicsTops1to3 = data.positions_summary.tops_dynamics[summaryKeys[0]];
        let positionSummaryDynamicsTops1to10 = data.positions_summary.tops_dynamics[summaryKeys[1]];
        let positionSummaryDynamicsTops11to30 = data.positions_summary.tops_dynamics[summaryKeys[2]];
        let positionSummaryDynamicsTops31to50 = data.positions_summary.tops_dynamics[summaryKeys[3]];
        let positionSummaryDynamicsTops51to100 = data.positions_summary.tops_dynamics[summaryKeys[4]];
        let positionSummaryDynamicsTops101to10000 = data.positions_summary.tops_dynamics[summaryKeys[5]];

        $(".positionSummaryAvg").text(positionSummaryAvg);

        $(".positionSummaryDynamicsDown").text(positionSummaryDynamicsDown);
        $(".positionSummaryDynamicsStay").text(positionSummaryDynamicsStay);
        $(".positionSummaryDynamicsUp").text(positionSummaryDynamicsUp);

        $(".positionSummaryTops1to3").text(positionSummaryTops1to3);
        $(".positionSummaryTops1to10").text(positionSummaryTops1to10);
        $(".positionSummaryTops11to30").text(positionSummaryTops11to30);
        $(".positionSummaryTops31to50").text(positionSummaryTops31to50);
        $(".positionSummaryTops51to100").text(positionSummaryTops51to100);
        $(".positionSummaryTops101to10000").text(positionSummaryTops101to10000);

        $(".positionSummaryDynamicsTops1to3").text(positionSummaryDynamicsTops1to3);
        $(".positionSummaryDynamicsTops1to10").text(positionSummaryDynamicsTops1to10);
        $(".positionSummaryDynamicsTops11to30").text(positionSummaryDynamicsTops11to30);
        $(".positionSummaryDynamicsTops31to50").text(positionSummaryDynamicsTops31to50);
        $(".positionSummaryDynamicsTops51to100").text(positionSummaryDynamicsTops51to100);
        $(".positionSummaryDynamicsTops101to10000").text(positionSummaryDynamicsTops101to10000);

        console.log(data);

    }
    /* Get order topvisor positions */

    $(".chosen-select").chosen({disable_search_threshold: 10});
    window.userFinder.init();
    window.optimizerFinder.init();
    window.faqCategoryFinder.init();
    window.datePickersManager.init();
    window.statisticsFormsManager.init();
    window.maintenancesLoader.init();
    window.validations.init();
    window.checklistSelector.init();
    window.checklistsStatusesSelector.init();
});

window.checklistsStatusesSelector = {
    init: function () {
        $(".checklists-statuses-selector").on('change', function () {
            let changeStatusTo = $(this).val();
            $("#checklists-for-maintenance-" + $(this).attr('maintenance-id')).find('.checklist-item-status-selector').each(function () {
                let $itemStatusSelectBox = $(this);
                if ($itemStatusSelectBox.find("option[value$='" + changeStatusTo + "']").length > 0) {
                    $(this).val($itemStatusSelectBox.attr('item-id') + "-" + changeStatusTo);
                }
            });
        });
    },
};

window.checklistSelector = {
    init: function () {
        $("#checklists-selector").on('change', function () {
            let selectedCategory = $(this).val();
            $(".tariff-checklist").hide();
            $("#checklists-for-maintenance-" + selectedCategory).show();
        });
    },
};

window.validations = {
    init: function () {
        $.extend($.validator.messages, {
            required: "Обязательно для заполнения",
        });
        this.initOrderFormValidations();
    },

    initOrderFormValidations: function () {
        let $orderForm = $("#order-form");
        let _self = this;
        $orderForm.validate({
            invalidHandler: function (e, validator) {
                if (validator.errorList.length) {
                    let closestTabId = jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id');

                    if (jQuery(validator.errorList[0].element).attr('id') === "keywords") {
                        $('#order-form .nav-tabs a[href="#checklists"]').tab('show');
                        $('#order-form .nav-tabs a.keywords-tab').tab('show');
                        $('#order-form .nav-tabs a[href="#new-keywords"]').tab('show');
                    }
                    if (closestTabId === "exceptional-checklist") {
                        $('#order-form > .nav-tabs a[href="#checklists"]').tab('show');
                        $('#order-form  .nav-tabs a[href="#exceptional-checklist"]').tab('show');
                    } else if (closestTabId === "new-keywords") {
                        $('#order-form .nav-tabs a[href="#checklists"]').tab('show');
                        $('#order-form .nav-tabs a.keywords-tab').tab('show');
                        $('#order-form .nav-tabs a[href="#new-keywords"]').tab('show');
                    } else {
                        $('#order-form > .nav-tabs a[href="#' + closestTabId + '"]').tab('show');
                    }
                }
            },
            ignore: ".no-validation"
        });
        $orderForm.find('.form-control[name!="comment"]:not([readonly])').each(function () {
            $(this).rules("add", {
                required: true,
            });
        });
    },

    validateTab: function (element) {

        var _element = $(element);
        var validatePane = _element.attr('data-target');
        var isValid = $(validatePane + ' :input').valid();
        var _li = _element.parent();

        console.log(validatePane + " - " + isValid);

        if (isValid) {
            _li.removeClass('alert-danger');
            _li.addClass('alert-success');
        } else {
            _li.removeClass('alert-success');
            _li.addClass('alert-danger');
        }
    }
};

window.maintenancesLoader = {
    init: function () {
        this.initLoading();
    },

    initLoading() {
        $("#tariff").on('change', function () {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    url: $("#loadMaintenancesByTariffURL").val(),
                    data: 'tariff=' + $(this).val(),
                    beforeSend: function () {
                        $(this).css("background", "#FFF url(../../images/LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#maintenances-tabs").html(data);
                    },
                    error: function () {
                        //TODO: BOOTSTRAP MODALS WITH SOME INFO
                    },
                    complete: function () {
                        window.checklistSelector.init();
                    }
                });
            } else {
                $("#maintenances-tabs").empty();
            }
        });
    },
};

window.statisticsFormsManager = {
    init: function () {
        this.toggleTabs();
    },

    toggleTabs: function () {
    }
};

window.datePickersManager = {

    CONFIG: {
        locale: 'ru', format: 'DD/MM/YYYY'
    },

    init: function () {
        this.initDatepickerIfExists($('#startDatePicker'));
        this.initDatepickerIfExists($('#endDatePicker'));
        this.initDatepickerIfExists($('#order-fromDate'));
        this.initDatepickerIfExists($('#order-toDate'));
    },

    initDatepickerIfExists: function ($element) {
        if ($element.length > 0) {
            $element.datetimepicker(this.CONFIG);
        }
    }
};

window.optimizerFinder = {
    init: function () {
        let _self = this;
        $("#optimizerToFind").keyup(function () {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    url: $("#findOptimizerURL").val(),
                    data: 'optimizerToFind=' + $(this).val(),
                    beforeSend: function () {
                        $("#optimizerToFind").css("background", "#FFF url(../../images/LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#optimizers-suggesstion-box").show();
                        $("#optimizers-suggesstion-box").html(data);
                        $("#optimizerToFind").css("background", "#FFF");
                    },
                    error: function () {
                        //TODO: BOOTSTRAP MODALS WITH SOME INFO
                    }
                });
            } else {
                $("#optimizerId").val('');
                $("#optimizers-suggesstion-box").hide();
            }
        });
    },

    optimizerFinderCallback: function (userData) {
        let userAsJSON = $.parseJSON(userData);
        $("#optimizers-suggesstion-box").hide();
        $("#optimizerId").val(userAsJSON.id);
        $("#optimizerName").val(userAsJSON.name);
        $("#optimizerSurname").val(userAsJSON.surname);
        $("#optimizerToFind").val(userAsJSON.email);
    }
};

window.userFinder = {
    init: function () {
        let _self = this;
        $("#emailToFind").keyup(function () {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    url: $("#findUserURL").val(),
                    data: 'emailToFind=' + $(this).val(),
                    beforeSend: function () {
                        $("#emailToFind").css("background", "#FFF url(../../images/LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#users-suggesstion-box").show();
                        $("#users-suggesstion-box").html(data);
                        $("#emailToFind").css("background", "#FFF");
                    },
                    error: function () {
                        //TODO: BOOTSTRAP MODALS WITH SOME INFO
                    }
                });
            } else {
                _self.resetUserInfo();
            }
        });
    },

    userFinderCallback: function (userData) {
        let userAsJson = $.parseJSON(userData);
        this.updateUserInfo(userAsJson);
        this.resetSearchForm();
    },

    updateUserInfo: function (userAsJson) {
        $("#userId").val(userAsJson.id);
        $("#userName").val(userAsJson.name);
        $("#userSurname").val(userAsJson.surname);
        $("#userFatherName").val(userAsJson.father_name);
        $("#userEmail").val(userAsJson.email);
        $("#emailToFind").val(userAsJson.email);
    },

    resetUserInfo: function () {
        $("#userId").val('');
        $("#userName").val('');
        $("#userSurname").val('');
        $("#userFatherName").val('');
        $("#userEmail").val('');
    },

    resetSearchForm: function (resetEmailToFind) {
        $("#users-suggesstion-box").hide();
    }

};

window.faqCategoryFinder = {
    init: function () {
        let _self = this;
        $("#faqCategoryToFind").keyup(function () {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    url: $("#findFaqCategoryURL").val(),
                    data: 'faqCategoryToFind=' + $(this).val(),
                    beforeSend: function () {
                        $("#faqCategoryToFind").css("background", "#FFF url(../../images/LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#faq-category-suggesstion-box").show();
                        $("#faq-category-suggesstion-box").html(data);
                        $("#faqCategoryToFind").css("background", "#FFF");
                    },
                    error: function () {
                        //TODO: BOOTSTRAP MODALS WITH SOME INFO
                    }
                });
            } else {
                _self.resetFaqCategoryInfo();
            }
        });
    },

    faqCategoryFinderCallback: function (faqCategoryData) {
        let faqCategoryAsJson = $.parseJSON(faqCategoryData);
        this.updateFaqCategoryInfo(faqCategoryAsJson);
        this.resetSearchForm();
    },

    updateFaqCategoryInfo: function (faqCategoryAsJson) {
        $("#faqCategoryToFind").val(faqCategoryAsJson.category);
    },

    resetFaqCategoryInfo: function () {

    },

    resetSearchForm: function (resetEmailToFind) {
        $("#faq-category-suggesstion-box").hide();
    }

};

function setCSRFToken() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
        }
    });
}

/* Firebase sign in/up */
function signIn(email, password) {
    firebase.auth().signInWithEmailAndPassword(email, password).catch(function (error) {
        // Handle Errors here.
        let errorCode = error.code;
        let errorMessage = error.message;
        if (errorCode) {
            console.log(errorMessage);
            return false;
        }
    });
    return true;
}

function signUp(email, password) {
    firebase.auth().createUserWithEmailAndPassword(email, password).catch(function (error) {
        // Handle Errors here.
        let errorCode = error.code;
        let errorMessage = error.message;
        if (errorCode) {
            console.log(errorMessage);
            return false;
        }
        return true;
    })
}

$("#logout-btn").click(function () {
    signOut();
});
let currentEmail = $('#firechat-wrapper-container').data('user-email') || null;
let currentUserName = $('#firechat-wrapper-container').data('user-name') || null;
let currentUserRole = $('#firechat-wrapper-container').data('user-role') || null;
if (currentEmail && currentEmail.length > 0) {
    signOut();
    signIn(currentEmail, '123456');
    setTimeout(function () {
        firebase.auth().onAuthStateChanged(function (user) {
            if (user) {
                if (currentUserRole === 'ROLE_ADMINISTRATOR' || currentUserRole === 'ROLE_TECHNICAL_MANAGER' || currentUserRole === 'ROLE_OPTIMIZER') {
                    let newEmail = currentEmail.split('.').join("");
                    user.updateProfile({
                        displayName: currentUserName + " (" + newEmail + ")",
                        photoURL: "https://example.com/jane-q-user/profile.jpg"
                    }).then(function () {
                        let displayName = user.displayName;
                        let photoURL = user.photoURL;

                        initChat(user);
                        /* Add image change functionality */
                        // userAvatar(user);
                    }, function (error) {
                        // An error happened.
                    });
                } else {
                    /* Start of Tawk.to Script */
                    let Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
                    (function () {
                        let s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                        s1.async = true;
                        s1.src = 'https://embed.tawk.to/5a508eebd7591465c7068552/default';
                        s1.charset = 'UTF-8';
                        s1.setAttribute('crossorigin', '*');
                        s0.parentNode.insertBefore(s1, s0);
                    })();
                    Tawk_API.visitor = {
                        name: user.displayName,
                        email: user.email
                    };
                    /* Start of Tawk.to Script */
                }

            } else {
                signUp(currentEmail, '123456');
            }
        });
    }, 5000);

}

function signOut() {
    firebase.auth().signOut();
    return true;
}

/* Progress Bar */
console.log(window.location.pathname);
if (window.location.pathname === '/charts') {
    let chartsContainer = $('.charts-container');
    setTimeout(function () {
        chartsContainer.show();
    }, 2000);
}

/* End Progress Bar */

let newMessagesCount = $(".newMessagesCount");
let newUserName = "";
let userNewAvatar = $(".user-new-avatar");

function getUserAvatar(user) {
    firebase.storage().ref().child('avatars/' + user.uid + '.jpg').getDownloadURL().then(function (url) {
        if (url) {
            $(".user-profile-img").attr("src", url);
        }
    }).catch(function (error) {
    });
}

function userAvatar(user) {
    getUserAvatar(user);
    $(".user-profile-img").click(function () {
        userNewAvatar.click();
        userNewAvatar.on('change', function (e) {
            let file = e.target.files[0];
            let storageRef = firebase.storage().ref('avatars/' + user.uid + '.jpg');
            let task = storageRef.put(file);

            task.on('state_changed', function progress(snapshot) {

            }, function error(err) {

            }, function complete() {
                getUserAvatar(user);
            });
        });
    })
}

function initChat(user) {
    // Get a Firebase Database ref
    let chatRef = firebase.database().ref("chat");


    // Create a Firechat instance
    let chat = new FirechatUI(chatRef, document.getElementById("firechat-wrapper"));

    // Set the Firechat user
    chat.setUser(user.uid, user.displayName);
    setTimeout(function () {
        chat.on('message-add', function () {
            checkOnlineUsersAdd(user.displayName);
            let audio = new Audio('../../sounds/open-ended.ogg');
            let messagesCountNumber = 0;
            audio.play();
            if (localStorage.getItem("chatTabExpanded") === "0") {
                messagesCountNumber = localStorage.getItem("newMessagesCount") * 1 + 1;
                newMessagesCount.text(messagesCountNumber).data("count", messagesCountNumber).show();
                localStorage.setItem("newMessagesCount", messagesCountNumber);
            }
        });

        firebase.database().ref('chat/user-names-online/').on('child_added', function (data) {
            checkOnlineUsersAdd(user.displayName);
        });

        firebase.database().ref('chat/user-names-online/').on('child_changed', function (data) {
            checkOnlineUsersAdd(user.displayName, data);
        });

        firebase.database().ref('chat/user-names-online/').on('child_removed', function (data) {
            checkOnlineUsersRemoved(user.displayName, data);
        });

        checkOnlineUsersAdd(user.displayName);
    }, 4000);
}

function checkOnlineUsersAdd(displayName) {
    let userId = firebase.auth().currentUser.uid;
    let userOnlineList = "";
    firebase.database().ref('chat/user-names-online/').once('value').then(function (snapshot) {
        userOnlineList = snapshot.val();
        for (let key in userOnlineList) {
            if (userOnlineList.hasOwnProperty(key)) {
                $("strong:contains('" + key.capitalize() + "')").prev('.user-online-status').addClass("is-online");
            }
        }
    });
}

function checkOnlineUsersRemoved(displayName, data) {
    let userId = firebase.auth().currentUser.uid;
    let userOnlineList = "";
    firebase.database().ref('chat/user-names-online/').once('value').then(function (snapshot) {
        userOnlineList = snapshot.val();
        for (let key in userOnlineList) {
            if (userOnlineList.hasOwnProperty(key)) {
                $("strong:not(:contains('" + key.capitalize() + "'))").prev('.user-online-status').removeClass("is-online");
            }
        }
    });
}

function chatToggle() {
    let firechatWrapperContainer = $("#firechat-wrapper-container");
    let firechatHeaderMinimize = $("#firechat-header-minimize");
    let glyphiconArrow = $(".firechat-header-minimize .glyphicon");
    if (localStorage.getItem("newMessagesCount") > 0) {
        newMessagesCount.text(localStorage.getItem("newMessagesCount"));
    } else {
        newMessagesCount.text("").hide();
    }

    $("#firechat-wrapper").click(function () {
        newMessagesCount.hide();
        localStorage.setItem("newMessagesCount", 0);
    });

    if (localStorage.getItem("chatTabExpanded") === "1") {
        firechatWrapperContainer.removeClass('chat-hidden');
        glyphiconArrow.removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');
    } else {
        firechatWrapperContainer.addClass('chat-hidden');
        glyphiconArrow.removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
    }

    firechatHeaderMinimize.click(function () {
        if (firechatWrapperContainer.hasClass('chat-hidden')) {
            firechatWrapperContainer.removeClass('chat-hidden');
            glyphiconArrow.removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');
            if (typeof(Storage) !== "undefined") {
                localStorage.setItem("chatTabExpanded", "1");
            } else {
                console.log("Sorry no support for local storage");
            }
        } else {
            firechatWrapperContainer.addClass('chat-hidden');
            glyphiconArrow.removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
            if (typeof(Storage) !== "undefined") {
                localStorage.setItem("chatTabExpanded", "0");
            } else {
                console.log("Sorry no support for local storage");
            }
        }
    })
}

chatToggle();