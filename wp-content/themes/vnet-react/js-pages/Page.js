import React from "react";
import { SimpleHeader } from "../js-components/SimpleHeader";


export const Page = ({ data }) => {
  return (
    <div className="page-content">
      <SimpleHeader bg={data.data.thumb} title={data.data.post_title} />
    </div>
  );
}