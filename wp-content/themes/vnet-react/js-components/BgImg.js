import React from "react";
import { LazyImg } from "./LazyImg";
import "./scss/BgImg.scss";

export const BgImg = ({ src }) => {
  return (
    <div className="bg-img overlay">
      <LazyImg src={src} alt="background image" />
    </div>
  );
}