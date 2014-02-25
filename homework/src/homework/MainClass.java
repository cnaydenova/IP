package homework;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Savepoint;
import java.sql.Statement;

public class MainClass {
	public static void main(String[] args) throws ClassNotFoundException,
			SQLException {
		Class.forName("org.apache.derby.jdbc.EmbeddedDriver");
		Connection con = DriverManager
				.getConnection("jdbc:derby:wombat;create=true");
		Statement stmt = con.createStatement();
		stmt.execute("CREATE TABLE Table2 ("
				+ "UID INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY(START WITH 1,INCREMENT BY 1),"
				+ "First_name VARCHAR(30)," + "Last_name VARCHAR(30),"
				+ "Birth_day DATE," + "Car_number VARCHAR(15))");

		stmt.execute("INSERT INTO Table2 (First_name,Last_name,Birth_day,Car_number) VALUES ('Pesho','Ivanov','1945.05.16','10')");
		stmt.execute("INSERT INTO Table2 (First_name,Last_name,Birth_day,Car_number) VALUES ('Petkan','Ivanchev','1973.05.16','1')");
		stmt.execute("INSERT INTO Table2 (First_name,Last_name,Birth_day,Car_number) VALUES ('Kristin','Naidenova','1934.12.11','123')");

		stmt.execute("UPDATE Table2 SET Birth_day = '1945.05.16' WHERE UID=1 ");

		stmt.execute("DELETE FROM Table2 WHERE First_name='Pesho'");

		stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
				ResultSet.CONCUR_UPDATABLE);
		ResultSet rs = stmt.executeQuery("SELECT * FROM Table2");
		while (rs.next()) {
			String s = rs.getString("UID");
			System.out.print(s);
			s = rs.getString("First_name");
			System.out.print(s);
			s = rs.getString("Last_name");
			System.out.print(s);
			s = rs.getString("Birth_day");
			System.out.print(s);
			s = rs.getString("Car_number");
			System.out.println(s);
		}
		stmt = con.createStatement();
		ResultSet rs2 = stmt
				.executeQuery("SELECT First_name FROM Table2 WHERE First_name LIKE 'Pe%'");
		while (rs2.next()) {
			String s = rs2.getString("First_name");
			System.out.print(s);
		}

		con.setAutoCommit(false);
		PreparedStatement updateSales = con
				.prepareStatement("UPDATE Table2 SET Birth_day = '1945.05.16' WHERE Last_name LIKE 'Iv%'");
		updateSales.setInt(1, 50);
		updateSales.setString(2, "krisi");
		updateSales.executeUpdate();
		PreparedStatement updateTotal = con
				.prepareStatement("UPDATE Table2 Car_number = 10 WHERE First_name LIKE 'Pe%'");
		updateTotal.setInt(1, 50);
		updateTotal.setString(2, "krisi");
		updateTotal.executeUpdate();
		con.commit();
		con.setAutoCommit(true);

		int rows = stmt.executeUpdate("INSERT INTO Table2 First_name ='krisi'");
		Savepoint svpt1 = con.setSavepoint("one");
		rows = stmt.executeUpdate("INSERT INTO Table2 Last_name='petur'");
		con.rollback(svpt1);

	}

}
