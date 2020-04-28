import React from "react";
import { HomeTopScreen } from "../js-template-blocks";


export const Page = ({ data }) => {
  if (data.isFrontPage) {
    return <FrontPage data={data.data} />;
  }
  return (
    <div className="page-content">
    </div>
  );
}




export const FrontPage = ({ data }) => {
  return (
    <div className="page-content">
      {data.fields ? <HomeTopScreen data={data.fields.home_top_screen} topInfo={data.fields.page_top_info} /> : null}
    </div>
  );
}