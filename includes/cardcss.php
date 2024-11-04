@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anton&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Lora:ital@1&display=swap");

:root {
--header-bg-color: green;
--color-blue: 368cbf#;
--color-slate: #33363b;
--color-light-grey: #eaeaea;
--color-yellow: #cdfac9;
--blue: #368cbf;
--green: #7ebc59;
--slate: #33363b;
--light-grey: #eaeaea;
--old-blue: #1339c2;
--old-light-blue: #335fff;
--orange: #f6653c;

/* Box Shadows */
--box-shadow-small: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
--box-shadow-large: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);
}

html {
font-size: 62.5%;
scroll-behavior: smooth;
}

.content {
height: 100vh;
max-width: 1200px;
display: flex;
justify-content: space-around;
align-items: center;
text-align: center;
overflow: hidden;
background-color: #9b4c38;
margin: 0 auto;
}

.card {
perspective: 1000px;
background-color: transparent;
height: 38rem;
width: 24rem;
cursor: pointer;
}

.card-inner {
position: relative;
width: 100%;
height: 100%;
text-align: center;
transition: transform 0.5s ease-in-out;
transform-style: preserve-3d;
}

.card:hover .card-inner {
transform: rotateY(180deg);
}

.card-front,
.card-back {
backface-visibility: hidden;
width: 100%;
height: 101%;
position: absolute;
top: 0;
right: 0;
margin: 0;
font-family: "Anton", sans-serif;
font-size: 4rem;
background-color: var(--slate);
box-shadow: 4px 8px 8px rgba(0, 0, 0, 0.5);
color: var(--light-grey);
display: flex;
flex-direction: column;
align-items: center;
}

.card-front {
background-color: var(--slate);
color: var(--light-grey);
}

.card-back {
background-color: var(--slate);
transform: rotateY(180deg);
margin: -2px 0;
position: relative;
display: flex;
justify-content: center;
align-items: center;
}

.card-back ul,
.card-front ul {
display: none;
list-style-type: none;
font-size: 1.6rem;
font-family: Montserrat, sans-serif;
padding: 1rem;
padding-top: 6rem;
margin: auto;
line-height: 2rem;
text-align: center;
}

.card-back ul {
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
}

/* H2 Styling */
.card h2 {
color: var(--light-grey);
margin-top: 2rem;
font-size: 4rem;
}

.img-container {
overflow: hidden;
height: 60%;
width: 100%;
clip-path: polygon(0 0, 100% 0%, 100% 75%, 50% 100%, 0 75%);
}

.img-container-back {
position: relative;
margin-top: 0px;
height: 100%;
clip-path: polygon(
50% 0%,
61% 35%,
98% 35%,
68% 57%,
79% 91%,
50% 70%,
21% 91%,
32% 57%,
2% 35%,
39% 35%
);
transition: all 0.3s ease-in-out;
}

.img-holder:hover .img-container-back {
filter: blur(10px);
opacity: 0;
}

.fa-eye {
color: var(--green);
}

.span1 {
position: absolute;
top: 50%;
left: 50%;
transform: scale(0.4) translate(-50%, -50%);
font-size: 5rem;
opacity: 0;
transition: all 0.3s;
}

/* Remove hover effects on mobile completely */
@media only screen and (max-width: 1000px) {

.content {
height: auto;
display: flex;
flex-direction: column;
justify-content: space-around;
padding: 20px;
}

.card {
height: auto;
width:350px;
padding-top: 2rem;
margin: 3rem;
background-color: var(--slate);
display: flex;
flex-direction: column;
align-items: center;
box-shadow: var(--box-shadow-large);

}

.hideme{
display: none;
}

/* Disable card flipping and hover effects on mobile */
.card-inner {
transform: none;
transition: none;
}

.card-front,
.card-back {
position: static;
transform: none;
width: 100%;
height: auto;
display: flex;
flex-direction: column;
justify-content: center;
}

.img-container {
height: 250px;
width: 80%;
clip-path: none;
}

.img-container-back {
clip-path: none;
}

.card h2 {
font-size: 3rem;
margin: 10px;
}

.card-back ul {
display: flex;
padding: 10px;
font-size: 1.6rem;
text-align: left;
}

.card:hover .card-inner {
transform: none;
}


/* Completely disable hover-related styles */
.img-holder:hover .img-container-back,
.img-holder:hover .span1 {
filter: none;
opacity: 1;
transform: none;
}
}
