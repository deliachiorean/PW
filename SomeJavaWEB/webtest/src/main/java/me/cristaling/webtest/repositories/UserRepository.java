package me.cristaling.webtest.repositories;

import me.cristaling.webtest.core.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.UUID;

@Repository
public interface UserRepository extends JpaRepository<User, UUID> {

	User getUserByUsername(String username);
	User getUserByUsernameAndPassword(String username,String username1);
	List<User> getUsersByUuidNot(UUID token);

}
