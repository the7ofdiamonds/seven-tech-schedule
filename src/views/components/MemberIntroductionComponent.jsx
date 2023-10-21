import React from 'react';

function MemberIntroductionComponent(props) {
  const { title, avatarURL, fullName, greeting } = props;

  return (
    <div class="author-intro">
      <div class="author">
        <h2 class="title">{title}</h2>
        
        <div class="author-card card">
          <div class="author-pic">
            <img src={avatarURL} alt="" />
          </div>
        </div>
        <h4 class="title">{fullName}</h4>
      </div>

      <div class="author-card card">
        <p class="author-greeting">{greeting}</p>
      </div>
    </div>
  );
}

export default MemberIntroductionComponent;
