(function(){
  const preloader = document.getElementById("preloader");
  const site = document.getElementById("site");
  const progressText = document.getElementById("progress-text");
  const progressFill = document.getElementById("progress-fill");

  const assets = document.images;
  const totalAssets = assets.length;
  let loadedAssets = 0;

  function updateProgress(){
    loadedAssets++;
    let percent = Math.round((loadedAssets / totalAssets) * 100);
    progressText.textContent = percent + "%";
    progressFill.style.width = percent + "%";

    if(loadedAssets === totalAssets){
      setTimeout(() => {
        preloader.classList.add("preloader-fadeout");
        preloader.addEventListener("animationend", () => preloader.remove());
        site.classList.remove("hidden-until-loaded");
      }, 400);
    }
  }

  if(totalAssets === 0){
    updateProgress();
  } else {
    for(let i=0;i<totalAssets;i++){
      if(assets[i].complete){
        updateProgress();
      } else {
        assets[i].addEventListener("load", updateProgress);
        assets[i].addEventListener("error", updateProgress);
      }
    }
  }

  // fallback
  setTimeout(() => {
    if(loadedAssets < totalAssets){
      preloader.classList.add("preloader-fadeout");
      site.classList.remove("hidden-until-loaded");
    }
  }, 8000);
})();