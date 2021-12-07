console.clear()
$(document).ready(function() {
    addChoice();
    startBtn();
})

function addChoice() {
    var item,
        target;
    $('#new-todo').on('keyup', function() {
        item = $('#new-todo').val();
        target = `<li class="tag">${item}<i class="material-icons" style="font-size:17px; color:#FF5757">&#xe15c;</i></li>`;
        return item;
        return target;
    });

    function start() {
        if ($('#choices-box li').length > 1) {
            $('.form .start').show();
        } else {
            $('.start').hide();
        };
    };
    start();

    function remove() {
        $('#choices-box li').find('i').on('click', function() {
            $(this).parents('li:first').remove()
            start();
        })
    };
    $('.form').on('submit', function(e) {
        e.preventDefault();
        $('#new-todo').val("");
        $('#choices-box').append(target);
        remove();
        start();
    });
};

function randomPick() {
    var times = 30;

    function randomSelectTag() {
        var tags = $('.tag');
        return tags[Math.floor(Math.random() * tags.length)];

    };

    function highlight(tag) {
        tag.classList.add('highlight');
    };

    function unhighlight(tag) {
        tag.classList.remove('highlight');
    };

    var interval = setInterval(function() {
        let result = randomSelectTag()
        highlight(result);
        setTimeout(function() {
            unhighlight(result);
        }, 100);
    }, 100);
    setTimeout(() => {
        clearInterval(interval);
        setTimeout(() => {
            let finalresult = randomSelectTag();
            highlight(finalresult)
        }, 100);
    }, times * 100);
};


function startBtn() {
    $('.start').click(function() {
        randomPick();
        if ($('.tag').hasClass('highlight')) {
            $('.tag').removeClass('highlight')
        }
    });
};