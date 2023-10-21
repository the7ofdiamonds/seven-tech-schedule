export const displayStatus = (status) => {
  if (status === 'Error (auth/too-many-requests): Firebase: Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later. (auth/too-many-requests).') {
    return 'Access to this account has been temporarily disabled due to too many failed login attempts. You can immediately restore it by resetting your password or you can try again later.';
  }

  if (status == 'Error (auth/wrong-password): Firebase: The password is invalid or the user does not have a password. (auth/wrong-password).') {
    return 'The password is invalid or the user does not have a password.'
  }

  if (status == 'Error (auth/user-not-found): Firebase: There is no user record corresponding to this identifier. The user may have been deleted. (auth/user-not-found).') {
    return 'There is no user record corresponding to this identifier. The user may have been deleted.';
  }

  return status;
};

export const displayStatusType = (status) => {
  if (status === 'Login successful' ||
    status === 'twins!!' ||
    status === 'You are now a user.') {
    return 'success';
  }

  if (status === 'Error (auth/user-not-found): Firebase: There is no user record corresponding to this identifier. The user may have been deleted. (auth/user-not-found).' ||
    status === 'Error (auth/wrong-password): Firebase: The password is invalid or the user does not have a password. (auth/wrong-password).') {
    return 'caution'
  }

  if (status === 'You have been logged out' ||
    status === 'Error (auth/too-many-requests): Firebase: Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later. (auth/too-many-requests).') {

    return 'error';
  }
};
