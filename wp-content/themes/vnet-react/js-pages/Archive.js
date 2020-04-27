import React from "react";
import { SimpleHeader } from "../js-components/SimpleHeader";
import { Link } from "../js-components/Link";

import "./scss/Archive.scss";


export const Archive = ({ data }) => {
  return (
    <div className="page-contnet">
      <SimpleHeader bg={`${back_dates.src}img/def_bg.jpg`} title={data.data.label} />
      <LoopPosts posts={data.posts} />
    </div>
  );
}





export const LoopPosts = ({ posts }) => {
  if (!posts || !posts.length) {
    return <NoPosts />;
  }
  return (
    <section className="loop-posts">
      <div className="container">
        {posts.map(post => <SinglePostLoop post={post} key={post.ID} />)}
      </div>
    </section>
  )
}





export const SinglePostLoop = ({ post }) => {
  return (
    <div className="single-post-loop">
      <div className="thumb">
        {post.thumb ? <img src={post.thumb} alt="thumbnail" /> : null}
      </div>
      <div className="content">
        <h3 className="title">
          <Link href={post.permalink} >
            {post.post_title}
          </Link>
        </h3>
      </div>
    </div>
  );
}





const NoPosts = () => {
  return (
    <div className="no-posts">
      Нет постов
    </div>
  );
}