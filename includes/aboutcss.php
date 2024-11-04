/* Main container */
#about {
display: flex;
flex-direction: column; /* Stack items vertically */
align-items: center;
background-image: url('img/parchment.webp');
background-size: cover;
background-position: center;
padding: 50px;
color: black;
}

/* Image container */
.image-container {
width: 100%;
max-width: 800px;
margin-bottom: 20px;
display: flex;
justify-content: center;
}

.image-container img {
width: 100%;
height: auto;
border-radius: 5px;
}

/* Text content */
.text-content {
max-width: 800px;
padding: 0 20px;
text-align: left;
margin-bottom: 20px;
}

/* Contact form */
.contact-form {
width: 100%;
max-width: 800px; /* Matches text-content for alignment */
background-color: #9b4c38;
padding: 20px;
border-radius: 5px;
font-size: 1.6rem;
color: #fff;
box-sizing: border-box; /* Includes padding and border in width */
}

/* Form elements */
.contact-form form {
width: 100%;
}

.contact-form input,
.contact-form textarea,
.contact-form select {
width: 100%;
max-width: 100%;
padding: 10px;
margin-bottom: 15px;
font-size: 1rem;
border: none;
border-radius: 5px;
box-sizing: border-box;
}

/* Labels */
.contact-form label {
display: block;
margin-bottom: 5px;
font-weight: bold;
}

/* Form group */
.form-group {
margin-bottom: 15px;
}

/* Form button styles */
.form-group button {
width: auto;
box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.4);
background-color: #21859f;
font-size: 1.6rem;
border: none;
padding: 10px 20px;
border-radius: 5px;
cursor: pointer;
}

.form-group button:hover {
background-color: #c53b56;
}

/* Text content headings */
.text-content h1 {
font-size: 60px;
font-family: "EB Garamond", serif;
color: black;
margin-bottom: 20px;
}

/* Text content paragraphs and lists */
.text-content p,
.text-content ul,
.text-content li {
font-size: 18px;
color: black;
line-height: 1.6;
}

/* Media Queries */

/* Medium screens */
@media (max-width: 992px) {
#about {
padding: 30px;
}

.text-content {
padding: 0;
text-align: center;
}

.text-content h1 {
font-size: 40px;
}

.contact-form {
padding: 20px;
font-size: 1.5rem;
}

.form-group button {
font-size: 1.4rem;
}
}

/* Small screens */
@media (max-width: 600px) {
.text-content h1 {
font-size: 30px;
}

.text-content p {
font-size: 16px;
}

.contact-form {
padding: 15px;
font-size: 1.4rem;
}

.form-group button {
width: 100%;
font-size: 1.4rem;
}
}
