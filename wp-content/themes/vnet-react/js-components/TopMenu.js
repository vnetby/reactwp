import React, { useState } from "react";

import { MenuList } from "./MenuList";
import { getMenu } from "../js-functions/globals";

export const TopMenu = () => {
  let [menu, setMenu] = useState(null);

  if (!menu) {
    getMenu('top_menu').then(res => setMenu(res));
    return <></>;
  }

  return (
    <MenuList menu={menu.top_menu} className="top-menu" />
  );
}




