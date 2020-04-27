import { dom } from "vnet-dom";


export async function getMenu(location) {
  let menu = await dom.ajax({ url: `${back_dates.ajaxurl}?action=vnet_get_menu`, data: location ? { location } : null });
  menu = dom.jsonParse(menu);
  return menu;
}

