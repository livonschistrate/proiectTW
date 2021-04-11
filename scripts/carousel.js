let currentCardIndex = 0;
let leftBtn = document.getElementById("leftBtn");
let rightBtn = document.getElementById("rightBtn");

rightBtn.addEventListener('click', () => goToCard(1));
leftBtn.addEventListener('click', () => goToCard(-1));

handleActiveButtons();

function goToCard(direction){
    let cards = document.getElementsByClassName("carousel-service");

    currentCardIndex += direction;
    
    for(let i = 0; i < cards.length; i++){
        cards[i].style.transform = `translateX(-${currentCardIndex * 100}%)`;
}
    handleActiveButtons();

    return undefined;
}

function goToNextCard() {
    let cards = document.getElementsByClassName("carousel-service");

    currentCardIndex++;

    for(let i = 0; i < cards.length; i++)
    {
        cards[i].style.transform = `translateX(-${currentCardIndex * 100}%)`;
    }
    
    handleActiveButtons();
}

function goToPrevCard(){
    let cards = document.getElementsByClassName("carousel-service");

    currentCardIndex--;

    for(let i = 0; i < cards.length; i++){
        cards[i].style.transform = `translateX(-${currentCardIndex * 100}%)`;
    }

    handleActiveButtons();
}


function handleActiveButtons() {
    let cards = document.getElementsByClassName("carousel-service");

    leftBtn.disabled = currentCardIndex === 0;
    rightBtn.disabled = currentCardIndex === (cards.length - 1);
}
