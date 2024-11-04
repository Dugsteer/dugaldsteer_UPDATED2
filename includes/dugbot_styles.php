<style>
@import url("https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap");

.form-container {
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
    text-align: center;
    font-size: 1.6rem;
}

.title-img {
    padding: 20px;
}

#picture {
    width: 370px;
    height: 100px;
    overflow: hidden;
    border-radius: 5px;
    ;
}

.chat-header-img {
    width: 620px;
    height: auto;
    transform: translate(-120px, -280px);

    margin: 10px auto;
    border-radius: 5px;
}

input[type="text"] {
    width: calc(100% - 110px);
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    background-color: #c60c30;
    color: #F5F5F5;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.toggleButton {
    position: fixed;
    bottom: 35px;
    right: 35px;
    z-index: 100;
    background-color: #21859f;
    font-size: 1.6rem;
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);
}

button:hover {
    background-color: #c53b56;
}

.clear-chat-btn {
    background-color: #111c24;
}

.clear-chat-btn:hover {
    background-color: #c60c30;
}

.chat-container {
    padding: 10px;
    margin: auto;
    margin-top: 20px;
    height: 300px;
    overflow-y: auto;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: white;
    opacity: 0.7;
}

.chat-message {
    margin: 10px;
    padding: 6px;
    border-radius: 5px;
    background-color: transparent;
}

.placeholder-message,
.assistant-message,
.user-message {
    background-color: rgba(255, 255, 255, 0.7);
    /* Slight transparency */
    margin: 10px 0;
    padding: 5px;
    border-radius: 5px;
    background-color: transparent;
    font-size: 1.6rem;
}

#toggleText {
    background-color: rgb(174, 94, 94);
    height: 600px;
    width: 400px;
    border-radius: 5px;
    padding: 15px;
    position: fixed;
    bottom: 5px;
    right: 5px;
    z-index: 1000;
}

@media only screen and (max-width: 900px) {

    .form-container {
        width: 100%;
        max-width: 400px;
        margin: 20px auto;
        text-align: center;
        font-size: 1rem;

    }

    button,
    input,
    optgroup,
    select,
    textarea {
        font-size: 14px;
    }

    #toggleText {
        background-color: #9b4c38 !important;
        margin: 20px auto;
        height: 110%;
        width: 100%;
        border-radius: 5px;
        padding: 15px;
        position: fixed;
        /* Or fixed if needed */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -40%);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        /* If there are multiple children and you want to align them vertically */
    }

    .chat-container {
        padding: 10px;
        margin: auto;
        margin-top: 20px;
        min-height: 50%;
        overflow-y: auto;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #F5F5F5;
        opacity: 1;
    }

    #picture {
        width: 280px;
        height: 100px;
        overflow: hidden;
        border-radius: 5px;
        margin: 0 auto;
    }

    .chat-header-img {
        width: 570px;
        height: auto;
        transform: translate(-150px, -250px);

        margin: 10px auto;
        border-radius: 5px;
    }

    button {
        padding: 5px 15px;
        background-color: #c60c30;
        color: #F5F5F5;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .toggleButton {

        font-size: 14px;
    }
}

</style>
