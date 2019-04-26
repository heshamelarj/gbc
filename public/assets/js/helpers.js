
window.onload = () => {
    if (/(edit|create)$/.test(window.location.pathname))
    manageImageUploadStyling();
};

const manageImageUploadStyling = () => {
    let uploadFile = document.querySelector('#s8feb4ca090_image_file');
    let uploadFileImage = document.querySelector('#employeImageUpload');
    console.log(uploadFile.classList);
    uploadFileImage.addEventListener('click', (e) => {
        //using Jquery
        uploadFile.click();

    });

    uploadFile.addEventListener('change', (event) => {
        uploadFileImage.src = URL.createObjectURL(event.target.files[0]);
    });
};

