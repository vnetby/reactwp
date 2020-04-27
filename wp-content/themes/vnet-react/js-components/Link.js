import React from "react";
import { dom } from "vnet-dom";



export const Link = ({ title, target, href, className, children }) => {
  return (
    <a href={href} className={className ? className : null} title={title ? title : null} target={target ? target : null} onClick={e => { e.preventDefault(); changeUrl(href) }} >
      {children}
    </a>
  );
}




const changeUrl = url => {
  if (window.location.pathname === url) return;
  dom.window.history.pushState({}, "", url);
  dom.dispatch(dom.window, 'popstate');
}
