$(window).ready(function () {
    const chosenDoor = $('#chosenDoor').text();
    const openedDoor = $('#openedDoor').text();
    const nextDoor = $('#nextDoor').text();
    const doorWithCar = $('#doorWithCar').text();
    const boolResult = nextDoor === doorWithCar;

    const showYakubForOpenedDoor = () => {
        $(`header > h1`).text(`Ведущий открывает дверь № ${openedDoor}`);
        $(`.door-${openedDoor} > img`).removeAttr('hidden');
    };

    const showOpenedDoor = () => {
        $(`header > h1`).text(`Дверь № ${openedDoor} открыта`);
        $(`.door-${openedDoor}`).removeClass('d-flex').addClass('d-none');
        $(`.opened-door-${openedDoor}`).removeClass('d-none').addClass('d-flex');
    };

    const changeChoise = () => {
        $(`header > h1`).text(`Меняем ваш выбор двери № ${chosenDoor} на дверь № ${nextDoor}`);
        $(`.door-${chosenDoor} > img`).remove();
        $(`.door-${nextDoor}`).append(`<img src='img/ok.png'>`);
        $(`.opened-door-${nextDoor}`).append(`<img src='img/ok.png'>`);
    };

    const showResult = () => {
        $(`.door-1`).removeClass('d-flex').addClass('d-none');
        $(`.opened-door-1`).removeClass('d-none').addClass('d-flex');
        $(`.door-2`).removeClass('d-flex').addClass('d-none');
        $(`.opened-door-2`).removeClass('d-none').addClass('d-flex');
        $(`.door-3`).removeClass('d-flex').addClass('d-none');
        $(`.opened-door-3`).removeClass('d-none').addClass('d-flex');
        const headerText = boolResult ? 'Подздравляем! Вы выиграли автомобиль!' : 'Бывает. В следующий раз повезет.';
        const doorImg = boolResult ? "<img src='img/yakub-success.jpeg'>" : "<img src='img/yakub-fail.jpeg'>"
        $(`header > h1`).text(headerText);
        $(`.opened-door-${nextDoor}`).append(doorImg);
    }

    $(`.door-${chosenDoor}`).append(`<img src='img/ok.png'>`);
    $(`.door-${openedDoor}`).append(`<img src='img/yakub-open.jpeg'`);
    $(`header > h1`).text(`Вы выбрали дверь № ${chosenDoor}`);
    setTimeout(showYakubForOpenedDoor, 2000);
    setTimeout(showOpenedDoor, 4000);
    setTimeout(changeChoise, 6000);
    setTimeout(showResult, 8000);
});