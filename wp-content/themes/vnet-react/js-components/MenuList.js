import React, { useState, useEffect } from "react";
import { dom } from "vnet-dom";
import { Link } from "./Link";



export const MenuList = ({ menu, className, onChange }) => {
  const [activeIndex, setActiveIndex] = useState(getActiveIndex(menu));

  useEffect(() => {
    const changeFn = () => {
      setActiveIndex(getActiveIndex(menu));
    }
    dom.window.addEventListener('popstate', changeFn);
    return () => {
      dom.window.removeEventListener('popstate', changeFn);
    }
  });

  return (
    <ul className={className}>
      {menu.map((item, i) => <MenuItem item={item} key={item.ID} isActive={activeIndex === i} onChange={e => { onChange && onChange(item); }} />)}
    </ul>
  );
}




const getActiveIndex = menu => {
  let total = menu.length;
  for (let i = 0; i < total; i++) {
    if (isCurrent(getUrl(menu[i].url))) return i;
  }
}





const MenuItem = ({ item, onChange, isActive }) => {
  let url = getUrl(item.url);
  let className = getItemClassName(item, isActive, item.childs);
  return (
    <li className={className}>
      <Link href={url} title={item.attr_title ? item.attr_title : null} target={item.target ? item.target : null} onClick={e => onChange && onChange(e)} >
        {item.title}
      </Link>
      {item.description ? <div className="menu-item-desc">{item.description}</div> : null}
      {item.childs ? <MenuList menu={item.childs} className="menu-child" /> : null}
    </li >
  );
}






const getUrl = link => {
  return link.replace(new RegExp(dom.window.location.origin), "");
}




const isCurrent = (url) => {
  let isActive = dom.window.location.pathname === url;
  return isActive;
}




const getItemClassName = (item, isActive, hasChildren) => {
  let className = `menu-item object-type-${item.object} object-id-${item.object_id}`;
  if (item.classes.length) className += ' ' + item.classes.join(' ');
  if (isActive) className += ' current-menu-item';
  if (hasChildren) className += ' has-children';
  return className;
}