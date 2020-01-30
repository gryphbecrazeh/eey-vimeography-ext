document.addEventListener("DOMContentLoaded", () => {
  let vimeoPlayer = document.querySelector(".vimeography-player");

  let eeyShare = document.createElement("div"),
    button = document.createElement("button");
  let buttonText = "Copy Link";
  eeyShare.className = "box";
  button.type = "button";
  button.className = "eey-share rounded-box";
  button.innerText = buttonText;

  button.addEventListener("click", () => {
    let iframe = document.querySelector("iframe");
    let url = iframe
      .getAttribute("src")
      .match(/(?<=video\/)\d+(?=\?)?/)
      .toString();
    url = `https://jcad.tv/videos/?video=${url}`;
    let input = document.createElement("input");
    input.value = url;
    document.body.appendChild(input);
    input.select();
    document.execCommand("copy");
    document.body.removeChild(input);
    button.innerText = "Copied...";
  });
  eeyShare.style.display = "none";
  eeyShare.appendChild(button);
  vimeoPlayer.appendChild(eeyShare);
  vimeoPlayer.addEventListener("mouseover", e => {
    eeyShare.style.display = "block";
  });
  vimeoPlayer.addEventListener("mouseleave", e => {
    eeyShare.style.display = "none";
    button.innerText = buttonText;
  });
  vimeoPlayer.style.position = "relative";
});
