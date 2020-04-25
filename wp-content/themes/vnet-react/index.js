import "./css/dev/index.scss";

import ReactDOM from "react-dom";
import React from "react";
import { dom } from "vnet-dom";


const startApp = () => {
  let container = dom.findFirst('#app');
  ReactDOM.render(<App />, container);
}



const App = () => {
  return (
    <div className="vadzim">
      vadzim
    </div>
  );
}






startApp();