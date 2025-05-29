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
    
    let counter = document.querySelector('.post__indicator'); 
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
  shareBtn.addEventListener('click', () => {
    if (shareBtn.disabled) return;
    console.log('Данные поста:', {
      images: images,
      tittle: postTittle.value.trim()
    });
  });
});