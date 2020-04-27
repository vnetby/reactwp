import React from "react";
import { dom } from "vnet-dom";
import { Link } from "./Link";



export const MenuList = ({ menu, className }) => {
  return (
    <ul className={className}>
      {menu.map(item => <MenuItem item={item} key={item.ID} />)}
    </ul>
  );
}





const MenuItem = ({ item }) => {
  let url = getUrl(item.url);
  let className = getItemClassName(item, url, item.childs);
  return (
    <li className={className}>
      <Link href={url} title={item.attr_title ? item.attr_title : null} target={item.target ? item.target : null} >
        {item.title}
      </Link>
      {item.description ? <div className="menu-item-desc">{item.description}</div> : null}
      {item.childs ? <MenuList menu={item.childs} className="menu-child" /> : null}
    </li>
  );
}



const getUrl = link => {
  return link.replace(new RegExp(dom.window.location.origin), "");
}




const isCurrent = (url) => {
  return dom.window.location.pathname === url;
}




const getItemClassName = (item, url, hasChildren) => {
  let className = `menu-item object-type-${item.object} object-id-${item.object_id}`;
  if (isCurrent(url)) className += ' current-menu-item';
  if (item.classes.length) className += ' ' + item.classes.join(' ');
  if (hasChildren) className += ' has-children';
  return className;
}