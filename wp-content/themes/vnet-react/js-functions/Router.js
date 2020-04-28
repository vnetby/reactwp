import React, { useState, useEffect } from "react";
import { Archive, Page, NotFound, Term } from "../js-pages";
import { dom } from "vnet-dom";


export const Router = () => {
  const [pageData, setPageData] = useState(null);

  useEffect(() => {

    function onUrlChange(e) {
      dom.ajax({ url: `${back_dates.ajaxurl}?action=vnet_get_page_data`, data: { page: dom.window.location.pathname } }).then(res => {
        setPageData(dom.jsonParse(res));
      });
    }

    dom.window.addEventListener('popstate', onUrlChange);

    return () => {
      dom.window.removeEventListener('popstate', onUrlChange);
    }

  });


  if (!pageData) {
    dom.ajax({ url: `${back_dates.ajaxurl}?action=vnet_get_page_data`, data: { page: dom.window.location.pathname } }).then(res => {
      setPageData(dom.jsonParse(res));
    });
    return <></>;
  }

  dom.document.title = pageData.page_title;

  if (pageData.status !== 'success') {
    return <NotFound />;
  }

  if (pageData.type === 'page') {
    return <Page data={pageData} />;
  }

  if (pageData.type === 'archive') {
    return <Archive data={pageData} />;
  }

  if (pageData.type === 'term') {
    return <Term data={pageData} />;
  }

  return <NotFound />;
}
