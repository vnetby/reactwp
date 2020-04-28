import React from "react";
import { BgImg, BgVideo } from "../js-components";

import "./scss/home_top_screen.scss";



export const HomeTopScreen = ({ data, topInfo }) => {
  if (!data) return <></>;

  return (
    <div className="front-screen">
      <Bg bg={data.bg} />
      <div className="container content-container">
        <div className="content-col cont-col">
          {topInfo ? <Title title={topInfo.title} /> : null}
        </div>
        <div className="banner-col cont-col">

        </div>
      </div>
      <div className="carousel-container"></div>
    </div>
  );
}




const Bg = ({ bg }) => {

  if (bg.view === 'img' && bg.img) {
    return <BgImg src={bg.img.url} />
  }
  if (bg.view !== 'img' && bg.video) {
    return <BgVideo src={bg.video.url} />
  }

  return <></>;
}



const Title = ({ title }) => {
  if (!title) return <></>;

  return (
    <h1 className="page-title" dangerouslySetInnerHTML={{ __html: title }}></h1>
  );
}