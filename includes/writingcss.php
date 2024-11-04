/* Stacked Images and Text Section */
#writing, #web, #about {
display: flex;
align-items: center;
justify-content: center;
height: 100%;
background-image: url('img/parchment.webp');
background-size: cover;
background-position: center;
padding: 50px;
color: black;
}

.stacked-images {
flex: 1;
display: flex;
flex-direction: column;
justify-content: space-between;
align-items: center;
max-width: 40%;
}

.contact-form {
width: 100%;
background-color: #9b4c38;
padding: 20px;
border-radius: 5px;
font-size: 1.6rem;
color: #fff;}

.form-group button {
box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);
background-color: #21859f;
font-size: 1.6rem;
border: none;
width: min-content;
padding: 10px 20px;
border-radius: 5px;}

.form-group button:hover {
background-color: #c53b56;
}

.stacked-images img {
width: 70%;
height: auto;
margin-bottom: 20px;
border-radius: 5px;
}

.text-content {
flex: 1;
padding: 50px;
text-align: left;
max-width:800px;
}

.text-content h1 {
font-size: 60px;
font-family: "EB Garamond", serif;
color: black;
margin-bottom: 20px;
}

.text-content p,.text-content > ul,
.text-content ul > li {
list-style-type: none;
font-size: 18px;
color: black;
line-height: 1.6;
}

@media (max-width: 992px) {
#writing, #web, #about {
flex-direction: column;
text-align: center;
}

.hider{
display: none;
}

.stacked-images {
max-width: 80%;
margin-bottom: 40px;
}

.contact-form {
width: 180%;
padding: 20px;
border-radius: 5px;
font-size: 1.6rem;
color: #fff;}



.text-content {
padding-left: 0;
}

.text-content h1 {
font-size: 40px;
}
}

@media (max-width: 600px) {
.stacked-images img {
margin-bottom: 15px;
}

.text-content h1 {
font-size: 30px;
}

.text-content p {
font-size: 16px;
}
}
