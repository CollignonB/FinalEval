let card = document.getElementsByClassName("card");
// console.log(card.length);
for(i=0; i<card.length; i++)
{
    console.log(card[i].childNodes);
    card[i].addEventListener("mouseover", function( event) 
        {
        event.target.style.backgroundColor = "cyan";
        console.log("je suis passé sur l'élément : ");
        console.log(event.target);
        });
    card[i].addEventListener("mouseout", function(event)
    {
        event.target.style.backgroundColor = "";
    })
}