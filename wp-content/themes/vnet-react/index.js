import "./css/dev/index.scss";

import ReactDOM from "react-dom";
import React from "react";
import { dom } from "vnet-dom";
// import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";
import { Router } from "./js-functions/Router";

import { TopMenu } from "./js-components/TopMenu";






const startApp = () => {
  let container = dom.findFirst('#app');
  ReactDOM.render(<App />, container);
}






const App = () => {
  return (
    <>
      <TopMenu />
      <Router />
    </>
  );
}







startApp();