import "./scss/TopMenu.scss";

import React, { useState, useEffect } from "react";
import { dom } from "vnet-dom";

import { MenuList } from "./MenuList";
import { getMenu } from "../js-functions/globals";
import { Link } from "../js-components/Link";



export const TopMenu = () => {
  let [menu, setMenu] = useState(null);


  if (!menu) {
    getMenu('top_menu').then(res => setMenu(res));
    return <></>;
  }

  return (
    <div className="top-bar">
      <div className="container lg-container">
        <TopLogo />
        <Offcanvas menu={menu} />
      </div>
    </div>
  );
}






const Offcanvas = ({ menu }) => {
  let [isOpenOffcanvas, setOpenOffcanvas] = useState(false);

  useEffect(() => {
    const changeFn = () => {
      setOpenOffcanvas(false);
    }

    dom.window.addEventListener('popstate', changeFn);

    return () => dom.window.removeEventListener('popstate', changeFn);
  });

  return (
    <>
      <div className={`hamburger hamburger--squeeze js-hamburger${isOpenOffcanvas ? ' is-active' : ''}`} onClick={() => isOpenOffcanvas ? setOpenOffcanvas(false) : setOpenOffcanvas(true)}>
        <div className="hamburger-box">
          <div className="hamburger-inner"></div>
        </div>
      </div>
      <div className={`offcanvas-menu${isOpenOffcanvas ? ' active' : ''}`}>
        <div className="container">
          <MenuList menu={menu.top_menu} className="top-menu" />
        </div>
      </div>
    </>
  );

}






const TopLogo = () => {
  const ABOUT = back_dates.about;
  return (
    <div className="top-logo">
      <Link href="/" className="top-logo-link">
        {ABOUT.logo.img ? <img src={ABOUT.logo.img.url} alt="top logo" /> : null}
        <div className="logo-text" dangerouslySetInnerHTML={{ __html: ABOUT.logo.text }}></div>
      </Link>
    </div>
  );
}

