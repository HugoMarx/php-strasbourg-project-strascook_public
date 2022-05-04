let thumbnail = document.querySelectorAll('.sv-thumbnail');

thumbnail.forEach(function(thumb) {
    thumb.addEventListener("click", (e) => {
      const target = "." + e.target.classList[1];
      let card = e.target.closest(".card");
      let cover = card.querySelector('.sv-cover');
      cover.setAttribute('src', e.target.src)
    });
  });