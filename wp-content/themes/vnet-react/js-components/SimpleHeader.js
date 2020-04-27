import React from "react";
import "./scss/SimpleHeader.scss";


export const SimpleHeader = ({ bg, title, subtitle }) => {
  return (
    <header className="header simple-header">
      {bg ? <div className="bg-img"><img src={bg} /></div> : null}
      <div className="container">
        {title ? <h1 className="page-title">{title}</h1> : null}
        {subtitle ? <h2 className="page-subtitle">{title}</h2> : null}
      </div>
    </header>
  );
}