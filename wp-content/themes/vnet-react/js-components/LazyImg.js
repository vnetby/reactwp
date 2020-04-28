import React, { useState, useRef, useEffect } from "react";
import { dom } from "vnet-dom";
import "./scss/LazyImg.scss";


export const LazyImg = ({ src, alt, width, height }) => {
  let [isVisible, setIsVisible] = useState(false);
  let [isLoad, setIsLoad] = useState(false);
  let img = useRef(null);

  useEffect(() => {

    const onWindowScroll = () => {
      if (isVisible || !img || !img.current || !dom.isInViewport(img.current)) return false;
      setIsVisible(true);
      return true;
    }

    onWindowScroll();

    dom.window.addEventListener('scroll', onWindowScroll);

    return () => {
      dom.window.removeEventListener('scroll', onWindowScroll);
    }
  });

  let style = {};

  if (width) style.width = width;
  if (height) style.height = height;

  if (!isVisible) {
    return (
      <div className="loading-image" style={style} ref={img} />
    );
  }

  if (!isLoad) {
    return (
      <img src={src} style={style} className="loading-image" onLoad={() => setIsLoad(true)} />
    );
  }

  return (
    <img src={src} alt={alt ? alt : null} className="loading-image loaded" />
  );
}
