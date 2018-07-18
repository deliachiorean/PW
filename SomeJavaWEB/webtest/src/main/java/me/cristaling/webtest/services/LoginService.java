package me.cristaling.webtest.services;

import me.cristaling.webtest.utils.JdbcUtils;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class LoginService {

	static LoginService instance;

	JdbcUtils jdbcUtils;

	public LoginService(JdbcUtils jdbcUtils) {
		instance = this;
		this.jdbcUtils = jdbcUtils;
	}

	public static LoginService getInstance() {
		return instance;
	}

	public String tryLogin(String username, String password) {
		String cmd = "SELECT * FROM public.users WHERE username = '" + username + "' AND password = '" + password + "'";
		System.out.println(cmd);
		try {
			Statement st = jdbcUtils.getConnection().createStatement();
			ResultSet rs = st.executeQuery(cmd);
			if (rs.next()) {
				String token = rs.getString(1);
				rs.close();
				st.close();
				return token;
			}
			rs.close();
			st.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return null;
	}

}
