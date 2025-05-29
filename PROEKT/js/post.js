document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const addPhotoBtn = document.getElementById('addPhotoBtn');
    const addMorePhotos = document.getElementById('addMorePhotos');
    const createPost = document.getElementById('createPost');
    const imagesContainer = document.getElementById('imagesContainer');
    const imagesSlider = document.getElementById('imagesSlider');
    const postTittle = document.getElementById('postTittle');
    const shareBtn = document.getElementById('shareBtn');
    const prevBtn = document.querySelector('.slider-icon_left');
    const nextBtn = document.querySelector('.slider-icon_right');
    let counter = document.querySelector('.post__indicator');
    
    let currentIndex = 0;
    let images = [];
    
    function newPost() {
        imagesSlider.innerHTML = '';
        
        images.forEach((img, index) => {
            const slide = document.createElement('div');
            slide.className = 'image-slide' + (index === currentIndex ? ' active' : '');
            slide.innerHTML = '<img src="' + img + '" alt="Фото">';
            imagesSlider.append(slide);
        });
        
        const shouldShowButtons = images.length > 1;
        prevBtn.classList.toggle('slider-icon_hidden', !shouldShowButtons);
        nextBtn.classList.toggle('slider-icon_hidden', !shouldShowButtons);
         
        if (images.length > 1) {
            counter = document.createElement('div');
            counter.className = 'post__indicator';
            counter.innerHTML = '<span class="post__indicator-text"></span>';
            imagesSlider.append(counter);
            counter.querySelector('.post__indicator-text').textContent = (currentIndex + 1) + '/' + images.length;
        } else {
            counter.remove();
        }
    }

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            newPost();
        });
        
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            newPost();
        });
    }
    
    function handleFileUpload(files) {
        files.forEach(file => {
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    images.push(event.target.result);
                    currentIndex = images.length - 1;
                    newPost();
                    createPost.classList.add('create-post_close');
                    imagesContainer.classList.add('images-container_open');
                    updateShareButton();
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    addPhotoBtn.addEventListener('click', () => fileInput.click());
    addMorePhotos.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => handleFileUpload(Array.from(e.target.files)));
    
    function updateShareButton() {
        const canShare = images.length > 0 && postTittle.value.trim() !== '';
        shareBtn.disabled = !canShare;
        shareBtn.classList.toggle('active', canShare);
    }
    
    postTittle.addEventListener('input', updateShareButton);
    
    shareBtn.addEventListener('click', async () => {
        if (shareBtn.disabled) return;
        
        try {
            // данные для отправки
            const postData = {
                title: postTittle.value.trim(),
                created_by: 1,
                images: images
            };
            
            // JSON
            const response = await fetch('../api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error();
            }

             // сообщение об успехе
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = 'Пост успешно сохранен!';
            document.querySelector('.content-wrapper').append(successMessage);

            createPost.classList.add('create-post_close');
            imagesContainer.classList.toggle('images-container');
            imagesSlider.classList.toggle('image-slide.active');
            prevBtn.classList.add('slider-icon_hidden');
            nextBtn.classList.add('slider-icon_hidden');
            counter.classList.add('post__indicator_hidden');
            successMessage.classList.add('visible');
            
            // очищаем данные 
            images = [];
            fileInput.value = '';
            postTittle.value = '';
            updateShareButton();
            
        } catch (error) {
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.textContent = 'Произошла ошибка, попробуйте еще раз';
            document.querySelector('.content-wrapper').prepend(errorElement);
            
        } 
    });
});