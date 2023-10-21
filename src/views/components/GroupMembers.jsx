function GroupMembers(props) {
  const { group } = props;

  return (
    <>
      {Array.isArray(group) && group.length > 0
        ? group.map((group_member) => (
            <div className="group">
              {group_member && typeof group_member === 'object' ? (
                <div class="author-card card">
                  <div className="author-pic">
                    <a href={group_member.author_url}>
                      <img src={group_member.avatar_url} alt="" />
                    </a>
                  </div>

                  <div class="author-name">
                    <h4 className="title">
                      {group_member.first_name} {group_member.last_name}
                    </h4>
                  </div>

                  <div class="author-role">
                    <h5>{group_member.role}</h5>
                  </div>

                  <div class="author-contact">
                    <a href={`mailto:${group_member.email}`}>
                      <i className="fa fa-envelope fa-fw"></i>
                    </a>
                  </div>
                </div>
              ) : (
                ''
              )}
            </div>
          ))
        : ''}
    </>
  );
}

export default GroupMembers;
