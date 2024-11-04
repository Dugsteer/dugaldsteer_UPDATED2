/* Stacked Images and Text Section */
#teaching, #translation {
display: flex;
align-items: center;
justify-content: center;
height: 100%;
background-color: #9b4c38;
background-size: cover;
background-position: center;
padding: 50px;
color: #F5F5F5;
}



.stacked-images {
flex: 1;
display: flex;
flex-direction: column;
justify-content: space-between;
align-items: center;
max-width: 40%;
}

.stacked-images img {
width: 70%;
height: auto;
margin-bottom: 20px;
border-radius: 5px;
}

.text-content-teaching {
flex: 1;
padding: 50px;
text-align: left;
max-width:600px;
}

.text-content-teaching h1 {
font-size: 60px;
font-family: "EB Garamond", serif;
color: #F5F5F5;
margin-bottom: 20px;
}

.text-content-teaching p {
font-size: 18px;
color: #F5F5F5;
line-height: 1.6;
}

@media (max-width: 992px) {
#teaching, #translation {
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

.text-content-teaching {
padding-left: 0;
}

.text-content-teaching h1 {
font-size: 40px;
}
}

@media (max-width: 600px) {
.stacked-images img {
margin-bottom: 15px;
}

.text-content-teaching h1 {
font-size: 30px;
}

.text-content-teaching p {
font-size: 16px;
}
}
